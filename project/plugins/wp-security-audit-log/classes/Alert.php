<?php
/**
 * WSAL_Alert Object class.
 *
 * @package Wsal
 */
final class WSAL_Alert {

	/**
	 * Alert type (used when triggering an alert etc).
	 *
	 * @var integer
	 */
	public $type = 0;

	/**
	 * Alert error level (E_* constant).
	 *
	 * @var integer
	 */
	public $code = 0;

	/**
	 * Alert category (alerts are grouped by matching categories).
	 *
	 * @var string
	 */
	public $catg = '';

	/**
	 * Alert sub category.
	 *
	 * @var string
	 */
	public $subcatg = '';

	/**
	 * Alert description (ie, describes what happens when alert is triggered).
	 *
	 * @var string
	 */
	public $desc = '';

	/**
	 * Alert message (variables between '%' are expanded to values).
	 *
	 * @var string
	 */
	public $mesg = '';

	/**
	 * Event object.
	 *
	 * @var string
	 */
	public $object = '';

	/**
	 * Event type.
	 *
	 * @var string
	 */
	public $event_type = '';

	/**
	 * Constructor.
	 *
	 * @param integer $type    - Type of alert.
	 * @param integer $code    - Code of alert.
	 * @param string  $catg    - Category of alert.
	 * @param string  $subcatg - Subcategory of alert.
	 * @param string  $desc    - Description.
	 * @param string  $mesg    - Alert message.
	 * @param string  $object  - Event object.
	 */
	public function __construct( $type = 0, $code = 0, $catg = '', $subcatg = '', $desc = '', $mesg = '', $object = '', $event_type = '' ) {
		$this->type       = $type;
		$this->code       = $code;
		$this->catg       = $catg;
		$this->subcatg    = $subcatg;
		$this->desc       = $desc;
		$this->mesg       = $mesg;
		$this->object     = $object;
		$this->event_type = $event_type;
	}

	/**
	 * Retrieves a value for a particular meta variable expression.
	 *
	 * @param string $expr Expression, eg: User->Name looks for a Name property for meta named User.
	 * @param array  $meta_data (Optional) Meta data relevant to expression.
	 * @return mixed The value nearest to the expression.
	 */
	protected function GetMetaExprValue( $expr, $meta_data = array() ) {
		if ( 'IPAddress' == $expr ) {
			if (array_key_exists( 'IPAddress', $meta_data ) ) {
				return implode( ', ', $meta_data['IPAddress'] );
			}
			return null;
		}

		// TODO: Handle function calls (and methods?).
		$expr = explode( '->', $expr );
		$meta = array_shift( $expr );
		$meta = isset( $meta_data[ $meta ] ) ? $meta_data[ $meta ] : null;
		foreach ( $expr as $part ) {
			if ( is_scalar( $meta ) || is_null( $meta ) ) {
				return $meta; // This isn't 100% correct.
			}
			$meta = is_array( $meta ) ? $meta[ $part ] : ( isset( $meta->$part ) ? $meta->$part : 'NULL' );
		}
		return is_scalar( $meta ) ? (string) $meta : var_export( $meta, true );
	}

	/**
	 * Expands a message with variables by replacing variables with meta data values.
	 *
	 * @param string        $orig_mesg      - The original message.
	 * @param array         $meta_data      - (Optional) Meta data relevant to message.
	 * @param callable|null $meta_formatter - (Optional) Callback for formatting meta values.
	 * @param integer       $occurrence_id  - (Optional) Event occurrence ID.
	 * @param mixed         $highlight      - (Optional) Highlight format.
	 * @return string The expanded message.
	 */
	protected function GetFormattedMesg( $orig_mesg, $meta_data = array(), $meta_formatter = null, $occurrence_id = 0, $highlight = null, $context = false ) {
		// Tokenize message with regex.
		$message = preg_split( '/(%.*?%)/', (string) $orig_mesg, -1, PREG_SPLIT_DELIM_CAPTURE );
		if ( ! is_array( $message ) ) {
			return (string) $orig_mesg;
		}
		// Handle tokenized message.
		foreach ( $message as $i => $token ) {
			// Handle escaped percent sign.
			if ( '%%' == $token ) {
				$message[ $i ] = '%';
			} elseif ( substr( $token, 0, 1 ) == '%' && substr( $token, -1, 1 ) == '%' ) {
				// Handle complex expressions.
				$message[ $i ] = $this->GetMetaExprValue( substr( $token, 1, -1 ), $meta_data );
				if ( $meta_formatter ) {
					$message[ $i ] = call_user_func( $meta_formatter, $token, $message[ $i ], $occurrence_id, $highlight );
				}
			}
		}
		// Compact message and return.
		return implode( '', $message );
	}

	/**
	 * Gets alert message.
	 *
	 * @param array         $meta_data      - (Optional) Meta data relevant to message.
	 * @param callable|null $meta_formatter - (Optional) Meta formatter callback.
	 * @param string|null   $mesg           - (Optional) Override message template to use.
	 * @param integer       $occurrence_id  - (Optional) Event occurrence ID.
	 * @param mixed         $highlight      - (Optional) Highlight format.
	 * @return string Fully formatted message.
	 */
	public function GetMessage( $meta_data = array(), $meta_formatter = null, $mesg = null, $occurrence_id = 0, $highlight = false, $context = false ) {
		return $this->GetFormattedMesg( is_null( $mesg ) ? $this->mesg : $mesg, $meta_data, $meta_formatter, $occurrence_id, $highlight, $context );
	}
}
