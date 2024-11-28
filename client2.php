<?php 
class Client {
public:
    int id;
    std::string firstname;
    std::string lastname;
    std::string email;
    std::string password;  // Store hashed password
    std::string reg_date;
    static std::string errorMsg;
    static std::string successMsg;

    // Constructor (consider using a separate function for password hashing)
    Client(const std::string& firstname, const std::string& lastname,
           const std::string& email, const std::string& password) {
        this->firstname = firstname;
        this->lastname = lastname;
        this->email = email;

        // Hash the password using a secure library function
        this->password = hashPassword(password);  // Replace with actual hashing logic
    }

    // Function to insert a client into the database (using prepared statements for security)
    bool insertClient(const std::string& tableName, std::shared_ptr<sql::Connection> conn) {
        try {
            // Prepare the SQL statement with placeholders for values
            std::string sql = "INSERT INTO " + tableName + " (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
            std::unique_ptr<sql::PreparedStatement> stmt(conn->prepareStatement(sql));

            // Bind values to placeholders
            stmt->setString(1, firstname);
            stmt->setString(2, lastname);
            stmt->setString(3, email);
            stmt->setString(4, password);

            // Execute the prepared statement
            stmt->execute();

            successMsg = "Client inserted successfully";
            return true;
        } catch (const sql::SQLException& e) {
            errorMsg = "Error inserting client: " + e.what();
            return false;
        }
    }

private:
    // Replace with your actual password hashing function using a secure library
    std::string hashPassword(const std::string& password) {
        // Implement secure password hashing using a library like bcrypt or Argon2
        return "hashed_password";  // Placeholder for actual hashed value
    }

    // Function to select all clients from the database (omitted for brevity)
    static std::vector<Client> selectAllClients(/* ... */);

    // Function to select a client by ID (omitted for brevity)
    static Client selectClientById(/* ... */);

    // Function to update a client (omitted for brevity)
    static bool updateClient(/* ... */);

    // Function to delete a client (omitted for brevity)
    static bool deleteClient(/* ... */);
};

// Static member variables (outside the class definition)
std::string Client::errorMsg = "";
std::string Client::successMsg = "";

// Implement functions for selectAllClients, selectClientById, updateClient, and deleteClient
// based on your chosen database library, following similar secure practices with prepared statements.

?>