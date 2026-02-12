<?php
class Validator {
    private $errors = [];
    
    public function validateRequired($field, $value, $fieldName) {
        if (empty(trim($value))) {
            $this->errors[$field] = "$fieldName is required";
            return false;
        }
        return true;
    }
    
    public function validateEmail($field, $email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = "Invalid email address";
            return false;
        }
        return true;
    }
    
    public function validateUsername($field, $username) {
        if (strlen($username) < 3 || strlen($username) > 20) {
            $this->errors[$field] = "Username must be 3-20 characters";
            return false;
        }
        
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            $this->errors[$field] = "Username can only contain letters, numbers and underscores";
            return false;
        }
        
        return true;
    }
    
    public function validatePassword($field, $password) {
        if (strlen($password) < 8) {
            $this->errors[$field] = "Password must be at least 8 characters";
            return false;
        }
        
        if (!preg_match('/[A-Z]/', $password)) {
            $this->errors[$field] = "Password must contain at least one uppercase letter";
            return false;
        }
        
        if (!preg_match('/[a-z]/', $password)) {
            $this->errors[$field] = "Password must contain at least one lowercase letter";
            return false;
        }
        
        if (!preg_match('/[0-9]/', $password)) {
            $this->errors[$field] = "Password must contain at least one number";
            return false;
        }
        
        if (!preg_match('/[@$!%*?&]/', $password)) {
            $this->errors[$field] = "Password must contain at least one special character (@$!%*?&)";
            return false;
        }
        
        return true;
    }
    
    public function validateConfirmPassword($password, $confirmPassword) {
        if ($password !== $confirmPassword) {
            $this->errors['confirm_password'] = "Passwords do not match";
            return false;
        }
        return true;
    }
    
    public function validateVideoTitle($field, $title) {
        if (strlen($title) < 3 || strlen($title) > 100) {
            $this->errors[$field] = "Title must be 3-100 characters";
            return false;
        }
        return true;
    }
    
    public function validateVideoDescription($field, $description) {
        if (strlen($description) > 500) {
            $this->errors[$field] = "Description must be less than 500 characters";
            return false;
        }
        return true;
    }
    
    public function validateFile($field, $file, $allowedTypes, $maxSize) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->errors[$field] = "File upload failed";
            return false;
        }
        
        if ($file['size'] > $maxSize) {
            $this->errors[$field] = "File is too large";
            return false;
        }
        
        $fileType = mime_content_type($file['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            $this->errors[$field] = "Invalid file type";
            return false;
        }
        
        return true;
    }
    
    public function getErrors() {
        return $this->errors;
    }
    
    public function hasErrors() {
        return !empty($this->errors);
    }
    
    public function clearErrors() {
        $this->errors = [];
    }
}
?>