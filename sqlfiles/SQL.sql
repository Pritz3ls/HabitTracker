CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(250) NOT NULL,
    password VARCHAR(250) NOT NULL,
    email VARCHAR(250) NOT NULL,
    user_type ENUM('client','admin') DEFAULT 'client',
    -- Log for users
    deleted_at DATETIME,
    user_xp INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    prefer_2FA ENUM('true', 'false') DEFAULT 'false'
);

CREATE TABLE habit_board(
    id INT AUTO_INCREMENT PRIMARY KEY,
    board_name VARCHAR(150) DEFAULT 'New Board',
    user_id INT NOT NULL,
    deleted_at DATETIME DEFAULT NULL,
        FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE habits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    board_id INT NOT NULL,
    habit_name VARCHAR(255) NOT NULL,
    repetition_type ENUM('daily', 'weekly', 'monthly', 'custom') NOT NULL,
    custom_interval_value INT DEFAULT NULL,  -- For custom repetition only
    status ENUM('none','started','complete') DEFAULT 'none',
    -- Dates for habits
    dayofweek ENUM('sunday','monday','tuesday','wednesday','thursday','friday','saturday') DEFAULT NULL,
    last_completion DATE DEFAULT '1990-1-1',
    -- Log for habits
    deleted_at DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    	FOREIGN KEY (board_id) REFERENCES habit_board(id)
);

CREATE TABLE habit_logs(
	log_id INT AUTO_INCREMENT PRIMARY KEY,
    habit_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    	FOREIGN KEY (habit_id) REFERENCES habits(id)
);

CREATE TABLE activity_logs(
	activity_log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    operation TEXT NOT NULL,
    log_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    	FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Bug Reports
CREATE TABLE bug_report(
    bug_id INT AUTO_INCREMENT PRIMARY KEY,
    report_title VARCHAR(255) NOT NULL,
    report_content TEXT NOT NULL,
    bug_status ENUM('pending','solved','duplicate','invalid') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)

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

-- Delete all habits
DROP TABLE habit_logs;
DROP TABLE habits;
DROP TABLE habit_board;