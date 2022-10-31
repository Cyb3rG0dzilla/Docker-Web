function loginUser($email, $password) {

    try {
        // Connecting to databas
        $db = new db();
        $db = $db->connect();

        $user = findUserByEmail($email, $db);

        if(empty($user)){
            echo 'User not found';
            exit;
        }
        if(!password_verify($password, $user['password'])) {
            echo 'Password does not match';
            exit;
        } 

        $expTime = time() * 3600;

        $jwt = getToken($user, $expTime);

        // Close databse
        $db = null;

    } catch(PDOException $e){
        echo $e->getMessage();
    }

    return $jwt;
}
