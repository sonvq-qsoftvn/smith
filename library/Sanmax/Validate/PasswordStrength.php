<?php

class Sanmax_Validate_PasswordStrength extends Zend_Validate_Abstract
{
    const LENGTH = 'passwordStrengthLength';
    const UPPER  = 'passwordStrengthUpper';
    const LOWER  = 'passwordStrengthLower';
    const DIGIT  = 'passwordStrengthDigit';

    /**
     * The minimum length a password should be
     *
     * @var integer
     */
    protected $_min = 6;

    /**
     * Flag that indicates if at least one uppercase letter is required
     *
     * @var boolean
     */
    protected $_requireUppercase = false;

    /**
     * Flag that indicates if at least one lowercase letter is required
     *
     * @var boolean
     */
    protected $_requireLowercase = false;

    /**
     * Flag that indicates if at least one digit is required
     *
     * @var boolean
     */
    protected $_requireDigit = false;

    /**
     * Message templates used be Zend_Validate
     *
     * @var array
     */
    protected $_messageTemplates = array(
        self::LENGTH => "Password must be at least %min% characters in length",
        self::UPPER  => "Password must contain at least one uppercase letter",
        self::LOWER  => "Password must contain at least one lowercase letter",
        self::DIGIT  => "Password must contain at least one digit character"
    );

    /**
     * Message variables used be Zend_Validate
     *
     * @var array
     */
    protected $_messageVariables = array(
        'min' => '_min',
    );

    /**
     * Sets the minimum length a password should be
     *
     * @param integer $min
     * @return Sanmax_Validate_PasswordStrength
     */
    public function setMinimumLength($min) {
		$this->_min = (int) $min;
		return $this;
    }

    /**
     * Sets if at least one uppercase letter is required
     *
     * @param boolean $required
     * @return Sanmax_Validate_PasswordStrength
     */
    public function setRequireUppercase($required = true) {
    	$this->_requireUppercase = (bool) $required;
    	return $this;
    }

    /**
     * Sets if at least one lowercase letter is required
     *
     * @param boolean $required
     * @return Sanmax_Validate_PasswordStrength
     */
    public function setRequireLowercase($required = true) {
    	$this->_requireLowercase = (bool) $required;
    	return $this;
    }

    /**
     * Sets if at least one digit is required
     *
     * @param boolean $required
     * @return Sanmax_Validate_PasswordStrength
     */
    public function setRequireDigit($required = true) {
    	$this->_requireDigit = (bool) $required;
    	return $this;
    }

    public function isValid($value)
    {
        $this->_setValue($value);
        $isValid = true;

        if (strlen($value) < $this->_min) {
            $this->_error(self::LENGTH);
            $isValid = false;
        }

        if ($this->_requireUppercase && !preg_match('/[A-Z]/', $value)) {
            $this->_error(self::UPPER);
            $isValid = false;
        }

        if ($this->_requireLowercase && !preg_match('/[a-z]/', $value)) {
            $this->_error(self::LOWER);
            $isValid = false;
        }

        if ($this->_requireDigit && !preg_match('/\d/', $value)) {
            $this->_error(self::DIGIT);
            $isValid = false;
        }

        return $isValid;
    }
}
