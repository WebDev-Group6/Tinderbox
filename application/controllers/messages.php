<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller
{
    public $base_uri = '/messages/';
    private $ci;

    public function initialize($dateformat = "Y.m.d - H:i:s")
    {
        $this->pm_model->initialize($dateformat); // add pm_model
    }

    function __construct()
    {
        parent::__construct();

        $this->ci = & get_instance();
        $this->config->load('form_validation', TRUE);
        $this->config->load('pm', TRUE);
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Pm_model', 'pm_model');
        $this->load->model('User_model', 'user_model');
        $this->lang->load('pm', 'english');
    }

    public function index()
	{
	    // original code
	    $this->messages();
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('messages_view');
		$this->load->view('footer_view');

	}

	/*show a specific message by message id
    views loaded: menu, details
    data for 'details' view: $message.*/
	function message($msg_id)
    {
        if( ! $msg_id) return;

        // Get message and flag it as read
        $message = $this->pm_model->get_message($msg_id);
        if($message)
        {
            $message = reset($message);
            // Flag message as read
            $this->pm_model->flag_read($msg_id);

            // Get recipients & get usernames instead of user ids for recipients and author
            $message[TF_PM_AUTHOR] = $this->user_model->get_username($message[TF_PM_AUTHOR]);
            $message[PM_RECIPIENTS] = $this->pm_model->get_recipients($message[TF_PM_ID]);
            $i = 0;
            foreach ($message[PM_RECIPIENTS] as $recipient)
            {
                $id = $recipient[TF_PMTO_RECIPIENT];
                $message[PM_RECIPIENTS][$i] = $this->user_model->get_username($id);
                $i++;
            }
            $data['message'] = $message;
        }
        else $data['message'] = array();

        //$this->load->view('menu');
        $this->load->view('details', $data);
    }

    /*show messages.
    views loaded: menu, list
    data for 'list' view: $messages (associative array|array|string).*/
    function messages($type = MSG_NONDELETED)
    {
        // Get & pass to view the messages view type (e.g. MSG_SENT)
        $data['type'] = $type;
        $messages = $this->pm_model->get_messages($type);

        if($messages)
        {
            // Get recipients & get usernames instead of user ids
            // for recipients and author & render message body correctly
            $i = 0;
            foreach ($messages as $message)
            {
                $messages[$i][TF_PM_BODY] = $this->render($messages[$i][TF_PM_BODY]);
                $messages[$i][TF_PM_AUTHOR] = $this->user_model->get_username($message[TF_PM_AUTHOR]);
                $messages[$i][PM_RECIPIENTS] = $this->pm_model->get_recipients($messages[$i][TF_PM_ID]);
                $j = 0;
                foreach ($messages[$i][PM_RECIPIENTS] as $recipient)
                {
                    $id = $recipient[TF_PMTO_RECIPIENT];
                    $messages[$i][PM_RECIPIENTS][$j] = $this->user_model->get_username($id);
                    $j++;
                }
                $i++;
            }
            $data['messages'] = $messages;
        }
        else $data['messages'] = array();

        //$this->load->view('menu');
        //$this->load->view('list', $data);
    }

    /*send a message by username
    views loaded: menu, compose*/
    function send($recipients = NULL, $subject = NULL, $body = NULL)
    {
        $rules = $this->config->item('pm_form', 'form_validation');
        $this->form_validation->set_rules($rules);

        $data['found_recipients'] = TRUE; // assume we'll find recipients - set to FALSE below otherwise
        $data['suggestions'] = array(); // if recipients not found by exact search, save suggestions here
        $message = array();
        // Set default vals passed via parameters
        $message[PM_RECIPIENTS] = $recipients;
        $message[TF_PM_SUBJECT] = $subject;
        $message[TF_PM_BODY] 	= $body;

        if($this->form_validation->run())
        {
            // Overwrite default vals from params if form validated with vals from POST
            $message[PM_RECIPIENTS] = $this->input->post(PM_RECIPIENTS, TRUE);
            $message[TF_PM_SUBJECT] = $this->input->post(TF_PM_SUBJECT, TRUE);
            $message[TF_PM_BODY] 	= $this->input->post(TF_PM_BODY, TRUE);
            // Lets operate on copies of POST input to preserve orig vals in case of failure
            $recipients = explode(";", $this->input->post(PM_RECIPIENTS, TRUE));
            $subject = $this->input->post(TF_PM_SUBJECT, TRUE);
            $body = $this->input->post(TF_PM_BODY, TRUE);

            $recipient_ids = array();
            // Get user ids of recipients - if not found, get usernames of suggestions
            foreach ($recipients as $recipient)
            {
                $result = $this->user_model->get_userids(trim($recipient));
                array_push($recipient_ids, reset($result));
                // Try non-exact search if none found to have suggestions - in this case $data['suggestions']
                // will contain an array with original strings as keys & arrays with suggestions as values.
                if( ! reset($result))
                {
                    $data['found_recipients'] = FALSE;
                    $suggestions = $this->user_model->get_userids(trim($recipient), FALSE);
                    if($suggestions)
                        foreach ($suggestions as $suggestion)
                            $data['suggestions'][$recipient] = $this->user_model->get_username($suggestion);
                }
            }

            if($data['found_recipients'])
            {
                if($this->pm_model->send_message($recipient_ids, $subject, $body))
                {
                    // On success: redirect to list view of messages
                    $this->session->set_flashdata('status', $this->lang->line('msg_sent'));
                    redirect($this->base_uri.'messages/'.MSG_NONDELETED);
                }
                else
                {
                    $status = $this->lang->line('msg_not_sent');
                    $this->session->set_flashdata('status', $status);
                    redirect($this->base_uri.'send/'.
                        $message[PM_RECIPIENTS].'/'.
                        $message[TF_PM_SUBJECT].'/'.
                        $message[TF_PM_BODY]);
                }
            }
            else $data['status'] = $this->lang->line('recipients_not_found');
        }

        // Only happens if sending msg unsuccessful above
        if(isset($status))
        {
            $data['status'] = $status;
            $this->session->set_flashdata('status', $status);
        }
        $data['message'] = $message;
       // $this->load->view('menu');
        $this->load->view('compose', $data);
    }

   /* delete a message from inbox or sent folder (move to trash) */
   function delete($msg_id, $type = MSG_NONDELETED, $redirect = TRUE)
   {
       if($msg_id >= 0)
           if($this->pm_model->flag_deleted($msg_id)) $status = $this->lang->line('msg_deleted');
           else $status = $this->lang->line('msg_not_deleted');
       else $status = $this->lang->line('msg_invalid_id');
       $this->session->set_flashdata('status', $status);

       // Redirect to $type (e.g. MSG_NONDELETED) view of messages
       if($redirect) redirect($this->base_uri.'messages/'.$type);
       else $this->session->keep_flashdata('status');
   }

   /*restore a message from trash and move to inbox or sent folder*/
   function restore($msg_id, $redirect = TRUE)
   {
       if($msg_id >= 0)
           if($this->pm_model->flag_undeleted($msg_id)) $status = $this->lang->line('msg_restored');
           else $status = $this->lang->line('msg_not_restored');
       else $status = $this->lang->line('msg_invalid_id');
       $this->session->set_flashdata('status', $status);

       // Redirect to trash bin view of messages
       if($redirect) redirect($this->base_uri.'messages/'.MSG_DELETED);
       else $this->session->keep_flashdata('status');
   }

   /*render the message body text*/
    function render($message_body)
    {
        $message_body = strip_tags($message_body, '');
        $message_body = stripslashes($message_body);
        $message_body = nl2br($message_body);
        return $message_body;
    }

	public function personalmessage()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('personalmessage_view');
		$this->load->view('footer_view');
	}
	public function groupmessage()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('groupmessage_view');
		$this->load->view('footer_view');
	}
}
