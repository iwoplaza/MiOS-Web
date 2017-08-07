function encryptPassword(username, password) {
    console.log("Encrypting password...");
    console.log(" - Username: ", username);
    console.log(" - Password: ", password);

    /*
        SJCL Encryption / Decryption
        var encrypted = sjcl.encrypt(password, secretString);
        var decrypted = sjcl.decrypt(password, encrypted);
    */

    var key = username + "@mios";
    var encrypted = sjcl.encrypt(key, password);
    console.log(" - Key: ", key);
    console.log(" - Hash: ", encrypted);

    return encrypted;
}