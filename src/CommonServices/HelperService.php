<?php
	
	namespace CommonServices;
	
	use DateTime;
	
	/**
	 * Created by PhpStorm.
	 * User: digital
	 * Date: 9/9/16
	 * Time: 10:26 AM
	 */
	class HelperService
	{
		/**
		 * Generate random string of defined length
		 *
		 * @param int  $length  Length of random string
		 * @param bool $intOnly Integer random string if set true only
		 * @return string Random string
		 */
		public static function getRandomString($length = 4, $intOnly = false)
		{
			$characters = $intOnly ? '0123456789' : '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$string     = '';
			
			for ($i = 0; $i < $length; $i++) {
				$string .= $characters[mt_rand(0, strlen($characters) - 1)];
			}
			
			return $string;
		}
		
		/**
		 * Description: Returns difference in hours between two dates.
		 *
		 * @param $dateFrom Date from which the following is substracted
		 * @param $dateTo   Date to which from date is subtracted.
		 * @return int Difference in hours
		 */
		public static function dateDiffInHours($dateFrom, $dateTo)
		{
			$dateFrom = new DateTime($dateFrom);
			$dateTo   = new DateTime($dateTo);
			$diff     = $dateFrom->diff($dateTo);
			$hours    = $diff->h;
			
			return $hours + ($diff->days * 24);
			
		}
		
		/**
		 * Generate a random password.
		 *
		 * @param int $length
		 * @return string
		 */
		public function generatePassword($length = 8)
		{
			return static::getRandomString($length);
		}
		
		/**
		 * Description: Returns time elapsed string.
		 *
		 * @param      $datetime
		 * @param bool $full
		 * @param bool $shorter
		 * @return string
		 */
		public static function timeElapsedString($datetime, $full = false, $shorter = false)
		{
			$now  = new DateTime();
			$ago  = new DateTime($datetime);
			$diff = $now->diff($ago);
			
			$diff->w = floor($diff->d / 7);
			$diff->d -= $diff->w * 7;
			
			$string = $shorter
				? ['y' => 'Y',
				   'm' => 'M',
				   'w' => 'W',
				   'd' => 'd',
				   'h' => 'h',
				   'i' => 'm',
				   //'s' => 's', //Uncomment to enable 34 seconds ago.
				]
				: [
					'y' => 'year',
					'm' => 'month',
					'w' => 'week',
					'd' => 'day',
					'h' => 'hour',
					'i' => 'minute',
					// 's' => 'second', //Uncomment to enable 34 seconds ago.
				];
			
			$space = $shorter ? '' : ' ';
			
			foreach ($string as $k => &$v) {
				if ($diff->$k) {
					$v = $diff->$k . $space . $v . ($diff->$k > 1 && !$shorter ? 's' : '');
				} else {
					unset($string[$k]);
				}
			}
			
			if (!$full) $string = array_slice($string, 0, 1);
			$appendAgo = $shorter ? '' : ' ago';
			
			return $string ? implode(', ', $string) . $appendAgo : 'just now';
		}
		
		/**
		 * Description: Count comment counts in K's
		 *
		 * @param $count
		 * @return string
		 */
		public static function commentCountsInKs($count)
		{
			if ($count < 999) {
				return $count;
			}
			
			return round($count / 1000, 1) . 'k';
		}
		
		/**
		 * Validate and add scheme.
		 *
		 * @param        $url
		 * @param string $scheme
		 * @return string
		 */
		public static function addScheme($url, $scheme = 'http://')
		{
			return parse_url($url, PHP_URL_SCHEME) === null ?
				$scheme . $url : $url;
		}
	}