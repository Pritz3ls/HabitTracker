CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(250) NOT NULL,
    password VARCHAR(250) NOT NULL,
    phone_number VARCHAR(250) NOT NULL,
    user_type ENUM('client','admin') DEFAULT 'client',
    -- Log for users
    deleted_at DATETIME,
    account_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE habits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    habit_name VARCHAR(255) NOT NULL,
    repetition_type ENUM('daily', 'weekly', 'monthly', 'custom') NOT NULL,
    custom_interval_value INT DEFAULT NULL,  -- For custom repetition only
    -- Dates for habits
    last_completion DATE DEFAULT '1990-1-1',
    -- Log for habits
    deleted_at DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    	FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE habit_logs(
	log_id INT AUTO_INCREMENT PRIMARY KEY,
    habit_id INT NOT NULL,
    habit_status ENUM('skipped','complete') DEFAULT 'skipped',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    	FOREIGN KEY (habit_id) REFERENCES habits(id)
);

CREATE TABLE activity_logs(
	activity_log_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    operation VARCHAR(250) NOT NULL,
    log_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    	FOREIGN KEY (admin_id) REFERENCES users(id)
);

/*
This SQL is for clients only,
we can create one for admin, so we can include user_type
*/
INSERT INTO users(user_name, password, phone_number)
VALUES ('Prince','PassTest','09893012687')


/*For non-Custom Habits*/
INSERT INTO habits(user_id, habit_name, repetition_type, start_date)
VALUES (1,'Walking','daily','2024-08-31')

/*For Custom Habits*/
INSERT INTO habits(user_id, habit_name, repetition_type, custom_repitition_value, start_date)
VALUES (1,'Jogging','custom', 5,'2024-08-31')
