<?php
    require_once('Entity/User.php');

    class UsersManager {
        private $_db;

        public function __construct(PDO $db) {
            $this->setDb($db);
        }

        public function __destruct() {
            unset($this->_db);
        }

        public function setDb(PDO $db): UsersManager {
            $this->_db = $db;

            return $this;
        }

        public function add(User $user): bool {
            $query = $this->_db->prepare('INSERT INTO `tbl_users` (`email`, `passwd`) VALUES (:email, :passwd);');
            $query->bindValue(':email', $user->getEmail());
            $query->bindValue(':passwd', $user->getPassword());

            return $query->execute();
        }

        public function remove(User $user): bool {
            $query = $this->_db->prepare("DELETE FROM tbl_users WHERE id = :id;");
            $query->bindValue(':id', $user->getId());
            
            return $query->execute();
        }

        public function getOne(int $id) {
            $sth = $this->_db->prepare('SELECT id, email, passwd FROM tbl_users WHERE id = ?');
            $sth->execute(array($id));
            $ligne = $sth->fetch();
            $user = new User($ligne);

            return $user;
        }

        public function getAll(): array {
            $usersList = array();
            $request = $this->_db->query('SELECT id, email, passwd, roles FROM tbl_users;');

            while ($ligne = $request->fetch(PDO::FETCH_ASSOC)) {
                $user = new User($ligne);
                $usersList[] = $user;
            }

            return $usersList;
        }

        public function update(User $user): bool {
            $query = $this->_db->prepare('UPDATE `tbl_users` SET `email`=:email, `roles`=:roles WHERE `id`=:id;');
            $query->bindValue(':email', $user->getEmail());
            $query->bindValue(':roles', $user->getRoles());
            $query->bindValue(':id', $user->getId());

            return ($query->execute());
        }
    }
?>