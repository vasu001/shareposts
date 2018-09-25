<?php

	class Posts extends Controller {

		public function __construct() {
			if(!isloggedIn()){
				redirect('users/login');
			}
			$this->postModel = $this->model('Post');
			$this->userModel = $this->model('User');
		}
		public function index() {
			// Get Post
			$posts = $this->postModel->getPost();
			$data = [
				'posts' => $posts,
				'user_id' => $_SESSION['user_id']
			];
			$this->view('posts/index', $data);
		}

		public function add() {
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// Add Post

				// Sanitize the Post
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$data = [
					'title' => $_POST['title'],
					'body' => $_POST['body'],
					'user_id' => $_SESSION['user_id'],
					'title_err' => '',
					'body_err' => ''
				];
				// Validate Title
				if(empty($data['title'])){
					$data['title_err'] = 'Please enter the title';
				}

				// Validate body
				if(empty($data['body'])){
					$data['body_err'] = 'Please enter body text';
				}

				// Make sure no errors
				if(empty($data['body_err']) && empty($data['title_err'])){
					// Validated

					if($this->postModel->addPost($data)) {
						flash('post_message', 'Post Added');
						redirect('posts');
					}else {
						die('Something went wrong');
					}
				} else {
					$this->view('posts/add', $data);
				}

			} else{

				$data = [
					'title' => '',
					'body' => ''
				];
				$this->view('posts/add', $data);
			}
		}
		
		public function edit($id) {
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// Add Post
							
				// Sanitize the Post
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$data = [
					'id' => $id,
					'title' => $_POST['title'],
					'body' => $_POST['body'],
					'user_id' => $_SESSION['user_id'],
					'title_err' => '',
					'body_err' => ''
				];
				// Validate Title
				if(empty($data['title'])){
					$data['title_err'] = 'Please enter the title';
				}

				// Validate body
				if(empty($data['body'])){
					$data['body_err'] = 'Please enter body text';
				}

				// Make sure no errors
				if(empty($data['body_err']) && empty($data['title_err'])){
					// Validated

					if($this->postModel->updatePost($data)) {
						flash('post_message', 'Post Updated');
						redirect('posts');
					}else {
						die('Something went wrong');
					}
				} else {
					$this->view('posts/edit', $data);
				}

			} else{

				// Get existing post from model
				$post = $this->postModel->getPostById($id);

				// Check for owner
				if($post->user_id != $_SESSION['user_id']) {
					redirect('posts');
				}

				$data = [
					'id' => $id,
					'title' => $post->title,
					'body' => $post->body
				];

				$this->view('posts/edit', $data);
			}
		}

		public function show($id) {
			$posts = $this->postModel->getPostById($id);
			$user = $this->userModel->getUserById($posts->user_id);
			$data = [
				'posts' => $posts,
				'user' => $user
			];
			$this->view('posts/show', $data);
		}

		public function delete($id) {
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				// Get existing post from model
				$post = $this->postModel->getPostById($id);

				// Check for owner
				if($post->user_id != $_SESSION['user_id']) {
					redirect('posts');
				}
				
				// Delete
				if($this->postModel->deletePost($id)){
					flash('post_message', 'Post Deleted');
					redirect('posts');
				} else {
					die('Something went wrong');
				}
			} else {
				redirect('posts');
			}

	}
}