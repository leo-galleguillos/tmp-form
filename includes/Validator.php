<?php

class Validator
{
    protected bool $isFormValid;
    protected array $errors;

    /**
     * Ideally we would want to use String and File\Image validator classes,
     * but that is beyond the scope of this demo.
     */
    public function validateForm(): void
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->isFormValid = false;
            return;
        }

        if (!$this->isUsernameValid()) {
            $this->isFormValid = false;
            $this->errors[]    = 'Invalid username.';
        }

        if (!$this->isEmailValid()) {
            $this->isFormValid = false;
            $this->errors[]    = 'Invalid email.';
        }

        if (!$this->isImageValid()) {
            $this->isFormValid = false;
            $this->errors[]    = 'Invalid image.';
        }

        if (!isset($this->isFormValid)) {
            $this->isFormValid = true;
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function isFormValid(): bool
    {
        if (!isset($this->isFormValid)) {
            throw new Exception('Run ::validateForm() before calling ::isFormValid()');
        }

        return $this->isFormValid;
    }

    protected function isUsernameValid(): bool
    {
        if (
            empty($_POST['username'])
            || !is_string($_POST['username'])
        ) {
            return false;
        }

        return true;
    }

    protected function isEmailValid(): bool
    {
        if (
            empty($_POST['email'])
            || !is_string($_POST['email'])
            || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
        ) {
            return false;
        }

        return true;
    }

    protected function isImageValid(): bool
    {
        if (
            empty($_FILES['image'])
            || empty($_FILES['image']['name'])
        ) {
            return false;
        }

        $fileExtension = pathinfo(
            $_FILES['image']['name'],
            PATHINFO_EXTENSION
        );
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            return false;
        }

        return true;
    }
}
