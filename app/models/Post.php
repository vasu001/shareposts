<?php

	class Post {

		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function getPost() {
			$this->db->query('SELECT *, posts.id AS postId, users.id AS userId, posts.createdAt AS post_created, users.created_at AS user_created FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY post_created DESC');
			$results = $this->db->resultSet();
			return $results;
		}

		public function addPost($data) {
			$this->db->query('INSERT INTO posts(user_id, title, body) VALUES(:user_id, :title, :body)');

            // Bind values
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']); 

            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
		}

		public function updatePost($data) {
			$this->db->query('UPDATE posts SET title = :title, body = :body WHERE id=:id');

            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']); 

            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
		}


		public function getPostById($id) {
			$this->db->query('SELECT * FROM posts WHERE id = :id');
			$this->db->bind(':id', $id);

			$results = $this->db->single();
			return $results;
		}

		public function deletePost($id) {
			$this->db->query('DELETE FROM posts WHERE id = :id');

			$this->db->bind(':id', $id);

			if($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}
	}