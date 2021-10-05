<?php
    class User {

        private $_id;
        private $_email;
        private $_password;
        private $_roles;

        public function __construct(array $ligne = null) {
            $this->hydrate($ligne);
        }

        public function hydrate(?array $ligne) {
            foreach ($ligne as $key => $value) {
                $method = 'set' . ucfirst($key);

                if (method_exists($this, $method)) {
                    $this->$method($value);
                }
            }
        }

        public function __toString() {
            return $this->getEmail() . " (" . $this->getId() . ")";
        }

        public function getEmail() {
            return $this->_email;
        }

        public function setEmail($email) {
            $this->_email = $email;

            return $this;
        }

        public function getPassword() {
            return $this->_password;
        }

        public function setPassword($password) {
            $this->_password = password_hash($password, PASSWORD_BCRYPT);

            return $this;
        }

        public function getRoles() {
            return $this->_roles;
        }

        public function setRoles($roles) {
            if (empty($roles)) {
                $roles = "ROLE_USER";
            }

            $this->_roles = $roles;

            return $this;
        }

        public function getId() {
            return $this->_id;
        }

        public function setId($id) {
            $this->_id = $id;

            return $this;
        }
    }
?>