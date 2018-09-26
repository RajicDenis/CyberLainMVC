# **CyberLainMVC**
==================================================================================  
### **Custom lightweight PHP MVC framework**
==================================================================================  

### CONFIG FILE
_______________________________________________________________
#### Edit the config file to setup the database connection
- Go to config/Config.php
- Define the DB constants to match your database name, user and password

==================================================================================  
### ROUTES	
_______________________________________________________________    
#### Defining routes:
- Go to routes/web.php
- A default route to the welcome page is already defined
- The setErrorPage() function needs to be defined at the end of the file (after all other routes)  
	- Sets the view to load if the requested route is not defined
- There are two ways of defining routes:

**ANONYMOUS FUNCTION**
```
	Route::get('/home', function() {
		require APPROOT .'views/welcome.php';
	});
```

**CONTROLLER METHOD**
```
	Route::get('/home', 'PageController@index');
```

==================================================================================  

### MODEL
_______________________________________________________________
- Create models inside the app/models directory
- A default User model is already created 
- Every model needs a construct method that connects to the database

```
public function __construct() {

	$database = new Database;
	$this->db = $database->connect();

	return $this->db;

}
```

- To use the simple query builder, you need to extend the Model class (e.g. class User extends Model {})

==================================================================================

### CONTROLLER
_______________________________________________________________
- Create controllers inside app/controllers directory
- Default UserController is already created
- Every controller needs to extend Controller to use the ->model() and ->view() methods
- To use the model and its methods inside the controller, you can require and instantiate
  the model using a construct method:

```
  	public function __construct() {

		$this->model = $this->model('User');

	}
```
- Inside $this->model() pass the model name (in this example 'User')
- To use methods defined in the model, simply use $this->model->method() (e.g. $this->model->getAllUsers())
- If you don't want to use $this->model, you can use the alternative method:
```
	$user = new User;
	$user->getAllUsers();
```

**Passing data to view:**
- The view() method accepts a second parameter which passes data to the view
```
$users = $this->model->getAllUsers();

return $this->view('welcome', $users);
```

==================================================================================

### VIEW
_______________________________________________________________
**Accessing the data in the view:**
- Any data that was passed to the view can be accessed using the $data variable
- In the next example, the data that was sent is the $users array from the previous example
```
<?php foreach($data as $user) { ?>
	<li><?php echo $user['name']; ?></li>
<?php } ?>
```
- If the passed data is a string:  

**Inside controller:**
```
return $this->view('welcome', 'Hello');
```
**Inside view:**
```
<h2><?php echo $data; ?></h2> // Outputs 'Hello'
```

==================================================================================

### ACCESSING MODEL METHODS AND PROPERTIES FROM CONTROLLER
_______________________________________________________________
#### First method

```
	$users = $this->model->getAllUsers();
```
#### Second method

```
	$user = new User;
	$users = $user->getAllUsers();
```

==================================================================================

### ACCESSING DATABASE
_______________________________________________________________
#### Define function to get or manipulate data inside model

```
	class User {
		public function getAllUsers() {

			$query = 'SELECT * FROM users';
			$stmt = $this->conn->prepare($query);
			$stmt->execute();

			$data = [];

			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				extract($row);

				$item_array = [
					'name' => $name,
					'email' => $email
				];

				array_push($data, $item_array);
			}
			return $data;
		}
	}
```
#### From Controller, call model method to manipulate database, then pass data to view
```
	class UsersController {

		public function index() {

			$users = $this->model->getAllUsers();

			return $this->view('welcome', $users);
		}
	} 
```

==================================================================================

### SIMPLE DATABASE QUERY BUILDER
_______________________________________________________________
#### Conditions 
	- You have to define protected $table = <table name> inside the model where you want to use the query builder
	- You have to extend the Model class (e.g. class User extends Model {})

#### Currently available methods

```
- where()
- orderBy()
- find()
- pluck()
- get()
- first()
```

	
