<?php

session_start();

// Simple script to log out
// Destroys the session so that the user has no saved data
// Then redirects page to the index
// As they do not have saved data it sends them to the login page

session_destroy();

header("Location: ../index.php");