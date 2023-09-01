<form action="" method="post">
<label for="email">Your email address</label>
<input name="user[email]" id="email" type="text">

<label for="name">Your name</label>
<input type="text" name="user[name]" id="name" type="text">

<label for="password">Password</label>
<input name="user[password]" id="password"  type="password">

<input type="submit" name="submit"  value="Register account">
</form>
<style>
form {
  width: 300px;
  margin: 0 auto; 
}

/* label {
  display: block;
  margin-bottom: 5px;
} */

input[type="text"],
input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 10px; 
}

input[type="submit"] {
  width: 100%;
  padding: 10px;
  background-color: #69c;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #58a;
} 


</style>