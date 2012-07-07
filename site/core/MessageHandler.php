<?php  
class MessageHandler {
	private static $messages = array();
        private static $count_error = 0;
        private static $count_warning = 0;
        private static $count_info = 0;
        private static $count_happy = 0;
	
	public static function add($message, $type = MSG_ERROR, $method = MESSAGE_AND_LOG) {
            
                foreach (self::$messages as $msg) {
                    if ($msg['message'] == $message && $msg['type'] == $type) {
                        return;
                    }
                }
            
		self::$messages[] = array('message' => $message, 'type' => $type, 'method' => $method);
                
                switch ($type) {
                    case MSG_ERROR:
                        self::$count_error ++;
                        break;
                    case MSG_WARNING:
                        self::$count_warning ++;
                        break;
                    case MSG_INFO:
                        self::$count_info ++;
                        break;
                    case MSG_HAPPY:
                        self::$count_happy ++;
                        break;
                }
                
                if ($method == LOG_ONLY || $method == MESSAGE_AND_LOG) {                    
                    if ($type == MSG_ERROR)
                        log_message('error', $message);
                    else
                        log_message('info', $message);
                }
	}
	
	public static function clear() {
		foreach (self::$messages as $k => $m) {
			unset(self::$messages[$k]);
		}
	}
	
	public static function getMessages() {
		return self::$messages;
	}
	
	public static function count() {
		return count(self::$messages);
	}
        
        public static function countError() {
            return self::$count_error;
        }
        
        public static function countWarning() {
            return self::$count_warning;
        }
        
        public static function countInfo() {
            return self::$count_info;
        }
        
        public static function countHappy() {
            return self::$count_happy;
        }
        
        public static function getDisplayMessages() {
            $display = array();
            
            foreach (self::$messages as $msg) {
                if ($msg['method'] == MESSAGE_ONLY || $msg['method'] == MESSAGE_AND_LOG) {
                    $display[] = $msg;
                }
            }
            
            return $display;
        }
        
}
