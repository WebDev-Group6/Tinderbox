<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @brief     Pm Model
 * @details
 * The model works using two tables: table1 contains the messages, table2
 * the referencing between the messages and the recipients - by message
 * and user IDs.
 *
 * NOTE: All operations are performed for the current user, given by
 * user id. This id is gotten from the {@link User_model} which contains
 * a dummy method always returning the first user id found. Replace this
 * method with a more meaningful own method.
 *
 * The class can be initialized by calling {@link initialize} which will
 * allow changing dateformat and enforce_field_types vars. It makes use
 * of the {@link Table_model} class to read, write and update table data.
 *
 * Copyright (c) 2015
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * @author    Balint Morvai
 * @version   0.9
 * @copyright MIT License
 */
class Pm_model extends CI_Model {
	/**
	 * @var object: table_model object that manages table1 (messages)
	 */
	private $table1;
	/**
	 * @var object: table_model object that manages table2 (links)
	 */
	private $table2;
	/**
	 * @var object: global CI instance that contains e.g. the db object
	 */
	private $ci;
	/**
	 * @var int: user id of the logged in user from the db
	 */
	private $user_id = NULL;
	/**
	 * @var array|array|mixed: two dimensional associative array with message fields
	 * (1st dimension int, 2nd dimension associative with field names as keys)
	 * set upon call to {@link get_messages} or {@link get_message}.
	 */
	public $messages = array();
	/**
	 * @var array|array|integer two dimensional array with recipients (by userid)
	 * of messsages - set upon call to {@link get_recipients}.
	 */
	public $recipients = array();

	/**
	 * @brief Pm_model constructor
	 *
	 * Pm_model constructor.
	 *
	 * @param dateformat string: format to display dates in
	 * @param enforce_field_types bool: setting whether to enforce field types in PHP by cast
	 * @return void
	 */
	public function __construct($dateformat = "Y.m.d - H:i:s", $enforce_field_types = TRUE)
	{
		parent::__construct();
		$this->ci = & get_instance();
		$this->load->model('User_model', 'user_model');
		$this->load->library('Table_model');
		$this->table1 = new Table_model(TABLE_PM, $dateformat, $enforce_field_types);
		$this->table2 = new Table_model(TABLE_PMTO, $dateformat, $enforce_field_types);
		$this->user_id = $this->user_model->current_id();
	}

	/**
	 * @brief initialize
	 *
	 * Initializes values for this class.
	 *
	 * @param dateformat string: format to display dates in
	 * @param enforce_field_types bool: setting whether to enforce field types in PHP by cast
	 * @return void
	 */
	public function initialize($dateformat = "d.m.Y - H:i", $enforce_field_types = TRUE)
	{
		// Define the date format & whether db field types are enforced in PHP by type cast
		$this->table1->initialize($dateformat, $enforce_field_types);
		$this->table2->initialize($dateformat, $enforce_field_types);
	}

	public function get_messages($type = MSG_NONDELETED)
	{
		// Lets use abbreviations
		$t1 = $this->table1->get_name();
		$t2 = $this->table2->get_name();

		$this->db->select($t1.'.*');
		$this->db->from($t1);
		// Specify what type of messages you want to get - conditions work with join;
		// Since db evaluates "AND" first "A AND B OR C AND D" = "(A AND B) OR (C AND D)"
		switch($type)
		{
			// Message types RECEIVED
			case MSG_NONDELETED:
				$this->db->where(TF_PMTO_RECIPIENT, $this->user_id);
				$this->db->where(TF_PMTO_DELETED, NULL);
				break;
			case MSG_DELETED:
				// this produces "(A AND B) OR (C AND D)"
				$this->db->where(TF_PMTO_RECIPIENT, $this->user_id);
				$this->db->where(TF_PMTO_DELETED, 1);
				$this->db->or_where(TF_PM_AUTHOR, $this->user_id);
				$this->db->where(TF_PM_DELETED, 1);
				break;
			case MSG_UNREAD:
				$this->db->where(TF_PMTO_RECIPIENT, $this->user_id);
				$this->db->where(TF_PMTO_DELETED, NULL);
				$this->db->where(TF_PMTO_READ, NULL);
				break;
			// Message type SENT
			case MSG_SENT:
				$this->db->where(TF_PM_AUTHOR, $this->user_id);
				$this->db->where(TF_PM_DELETED, NULL);
				break;
			// Message type RECEIVED OR SENT (deleted or not, sent to or by this user)
			default:
				$this->db->where(TF_PMTO_RECIPIENT, $this->user_id);
				$this->db->where(TF_PM_AUTHOR, $this->user_id);
				break;
		}
		// Get messages by join of table1 & 2
		$this->db->join($t2, TF_PMTO_MESSAGE.' = '.TF_PM_ID);
		$this->db->group_by(TF_PM_ID); // To get only distinct messages
		$this->db->order_by(TF_PM_DATE, 'desc');

		return $this->table1->get_data();
	}

	public function get_message($msg_id)
	{
		// Lets use abbreviations
		$t1 = $this->table1->get_name();
		$t2 = $this->table2->get_name();

		// Get message by join of table1 & 2
		$this->db->select($t1.'.*');
		$this->db->from($t1);
		// this produces "(A AND B) OR (A AND C)" = "A AND (B OR C)"
		$this->db->where(TF_PM_ID, $msg_id);
		$this->db->where(TF_PMTO_RECIPIENT, $this->user_id);
		$this->db->or_where(TF_PM_ID, $msg_id);
		$this->db->where(TF_PM_AUTHOR, $this->user_id);
		$this->db->join($t2, TF_PMTO_MESSAGE.' = '.TF_PM_ID);

		return $this->table1->get_data();
	}

	public function get_recipients($msg_id)
	{
		// Lets use abbreviations
		$t2 = $this->table2->get_name();

		// Get recipients from table2
		$this->db->select(TF_PMTO_RECIPIENT);
		$this->db->from($t2);
		$this->db->where(TF_PMTO_MESSAGE, $msg_id);

		return $this->table2->get_data();
	}

	public function get_author($msg_id)
	{
		$message = $this->get_message($msg_id);
		if($message)
		{
			$message = reset($message);
			$author = $message[TF_PM_AUTHOR];
		}
		else
			$author = -1;

		return $author;
	}

	function flag_read($msg_id, $allow_notify = TRUE)
	{
		// Lets use abbreviations
		$t2 = $this->table2->get_name();

		$this->db->set(TF_PMTO_READ, 1);
		$this->db->set(TF_PMTO_RDATE, 'NOW()', FALSE);
		if($allow_notify) $this->db->set($t2.'.'.TF_PMTO_ALLOWNOTIFY, 1);
		$this->db->limit(1, 0);
		$this->db->where(TF_PMTO_MESSAGE, $msg_id);
		$this->db->where(TF_PMTO_RECIPIENT, $this->user_id);

		return $this->table2->update_data();
	}

	function flag_deleted($msg_id, $status = 1)
	{
		$this->db->limit(1, 0);
		if($this->get_author($msg_id) == $this->user_id)
		{
			$this->db->set(TF_PM_DELETED, $status);
			$this->db->set(TF_PM_DDATE, 'NOW()', FALSE);
			$this->db->where(TF_PM_ID, $msg_id);
			$this->db->where(TF_PM_AUTHOR, $this->user_id);
			return $this->table1->update_data();
		}
		else
		{
			$this->db->set(TF_PMTO_DELETED, $status);
			$this->db->set(TF_PMTO_DDATE, 'NOW()', FALSE);
			$this->db->where(TF_PMTO_MESSAGE, $msg_id);
			$this->db->where(TF_PMTO_RECIPIENT, $this->user_id);
			return $this->table2->update_data();
		}
	}

	function flag_undeleted($msg_id)
	{
		return $this->flag_deleted($msg_id, NULL);
	}

	function send_message($recipients, $subject, $body, $notify = TRUE)
	{
		// Check notify
		if( ! $notify) $notify = NULL;
		else $notify = TRUE;
		// Check recipients
		if( ! is_array($recipients)) $recipients = array($recipients);

		foreach ($recipients as $recipient)
			if( ! $this->user_model->table1->is_valid_index($recipient))
				return FALSE;

		// insert message in table1
		$this->db->set(TF_PM_AUTHOR, $this->user_id);
		$this->db->set(TF_PM_DATE, 'NOW()', FALSE);
		$this->db->set(TF_PM_SUBJECT, $subject);
		$this->db->set(TF_PM_BODY, $body);
		$this->db->set(TF_PM_NOTIFY, $notify);
		if( ! $this->table1->insert_data())
			return FALSE;
		$msg_id = $this->table1->insert_id;

		// insert links to it for recipients in table2
		$failed = FALSE; // if sth. fails here, more complex cleanup is required
		foreach ($recipients as $recipient)
		{
			// Do not allow sending messages to oneself!
			if($recipient != $this->user_id)
			{
				$this->db->set(TF_PMTO_MESSAGE, $msg_id);
				$this->db->set(TF_PMTO_RECIPIENT, $recipient);
				if( ! $this->table2->insert_data())
					$failed = TRUE;
			}
		}
		// on failure remove all we just inserted & return FALSE
		if($failed)
		{
			$this->table1->delete_data(array(TF_PM_ID => $msg_id));
			$this->table2->delete_data(array(TF_PMTO_MESSAGE, $msg_id));
			return FALSE;
		}

		return TRUE;
	}
}

/* End of file Pm_model.php */
