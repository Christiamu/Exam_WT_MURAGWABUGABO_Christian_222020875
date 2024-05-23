-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 07:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinetherapysessionsplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `therapist_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `appointment_time` datetime DEFAULT NULL,
  `status` enum('scheduled','canceled','completed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `therapist_id`, `client_id`, `appointment_time`, `status`) VALUES
(4, 1, 3, '2024-05-15 10:00:00', 'scheduled'),
(5, 2, 2, '2024-05-16 11:00:00', 'scheduled'),
(6, 1, 5, '2024-05-17 12:00:00', 'scheduled');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `user_id`) VALUES
(4, 1),
(5, 2),
(1, 3),
(3, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `therapist_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `note_body` text DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `session_id`, `therapist_id`, `client_id`, `note_body`, `timestamp`) VALUES
(1, 1, 1, 3, 'Client showed progress in managing stress.', '2024-05-10 11:05:00'),
(2, 2, 2, 4, 'Family members expressed improved communication.', '2024-05-11 12:05:00'),
(3, 3, 1, 5, 'Client discussed strategies for coping with anxiety.', '2024-05-12 11:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `therapist_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `client_id`, `therapist_id`, `session_id`, `amount`, `payment_date`, `payment_method`) VALUES
(1, 3, 1, 1, 50, '2024-05-10', 'Credit Card'),
(2, 4, 2, 2, 60, '2024-05-11', 'PayPal'),
(3, 5, 1, 3, 45, '2024-05-12', 'Credit Card');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `user_id`, `name`, `gender`, `date_of_birth`, `address`) VALUES
(1, 1, 'John Doe', 'Male', '0000-00-00', '123 Main St, Anytown'),
(2, 2, 'Jane Smith', 'Female', '1985-05-15', '456 Oak St, Othertown'),
(3, 3, 'Mike Jones', 'Male', '1975-08-20', '789 Elm St, Thirddown'),
(4, 4, 'Sarah Davis', 'Female', '1990-02-28', '101 Pine St, Fourthtown'),
(5, 1, 'Chris Evans', 'Male', '1978-11-12', '202 Cedar St, Fifthtown'),
(6, 3, 'Emily Wilson', 'Female', '1982-04-30', '303 Maple St, Sixtown'),
(7, 4, 'Olivia Brown', 'Female', '1987-09-10', '404 Oak St, Seventhtown');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `therapist_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `review_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `session_id`, `therapist_id`, `client_id`, `rating`, `review_text`, `review_date`) VALUES
(1, 1, 1, 3, 5, 'Great session, very helpful.', '2024-05-10'),
(2, 2, 2, 4, 4, 'Good experience, would recommend.', '2024-05-11'),
(3, 3, 1, 5, 4, 'Effective strategies discussed.', '2024-05-12');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL,
  `therapist_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `session_type` enum('individual','group') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `therapist_id`, `client_id`, `start_time`, `end_time`, `session_type`) VALUES
(1, 1, 3, '2024-05-10 10:00:00', '2024-05-10 11:00:00', 'individual'),
(2, 2, 4, '2024-05-11 11:00:00', '2024-05-11 12:00:00', 'individual'),
(3, 1, 1, '2024-05-12 10:00:00', '2024-05-12 11:00:00', 'individual');

-- --------------------------------------------------------

--
-- Table structure for table `session_files`
--

CREATE TABLE `session_files` (
  `file_id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `therapist_id` int(11) DEFAULT NULL,
  `file_name` varchar(200) DEFAULT NULL,
  `file_url` varchar(200) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_files`
--

INSERT INTO `session_files` (`file_id`, `session_id`, `user_id`, `therapist_id`, `file_name`, `file_url`, `timestamp`) VALUES
(1, 1, 3, 1, 'notes_session1.pdf', 'https://example.com/notes_session1.pdf', '2024-05-10 11:10:00'),
(2, 2, 4, 2, 'notes_session2.pdf', 'https://example.com/notes_session2.pdf', '2024-05-11 12:10:00'),
(3, 3, 2, 1, 'notes_session3.pdf', 'https://example.com/notes_session3.pdf', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `therapists`
--

CREATE TABLE `therapists` (
  `therapist_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `availability` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `therapists`
--

INSERT INTO `therapists` (`therapist_id`, `user_id`, `specialization`, `bio`, `availability`) VALUES
(1, 4, 'Cognitive Behavioral Therapy (CBT)', 'I specialize in cognitive behavioral therapy (CBT) to help individuals overcome negative thought patterns and behaviors. With over 10 years of experience, I have helped numerous clients achieve their mental health goals and lead fulfilling lives.', 'Monday, Wednesday, Friday: 9am - 5pm'),
(2, 2, 'Marriage and Family Therapy', 'As a licensed marriage and family therapist, I work with couples and families to improve communication, resolve conflicts, and strengthen relationships. My approach is collaborative and solution-focused, aiming to create a supportive environment for growth and healing.', 'Tuesday, Thursday: 10am - 8pm, Saturday: 9am - 1pm'),
(3, 3, 'Addiction Counseling', 'With a background in addiction counseling, I assist individuals in overcoming substance abuse and addictive behaviors. My therapeutic approach integrates evidence-based techniques with empathy and understanding, empowering clients to make positive changes in their lives.', 'Monday to Friday: 12pm - 7pm'),
(4, 1, 'Trauma Therapy', 'I specialize in trauma therapy, helping individuals recover from past traumatic experiences and develop healthy coping mechanisms. Through a combination of trauma-informed care and mindfulness practices, I support clients in their journey towards healing and resilience.', 'Wednesday, Thursday, Saturday: 9am - 6pm');

-- --------------------------------------------------------

--
-- Table structure for table `therapist_schedule`
--

CREATE TABLE `therapist_schedule` (
  `schedule_id` int(11) NOT NULL,
  `therapist_id` int(11) DEFAULT NULL,
  `day_of_week` varchar(20) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `therapist_schedule`
--

INSERT INTO `therapist_schedule` (`schedule_id`, `therapist_id`, `day_of_week`, `start_time`, `end_time`) VALUES
(1, 1, 'Monday', '09:00:00', '17:00:00'),
(2, 1, 'Wednesday', '09:00:00', '17:00:00'),
(3, 1, 'Friday', '09:00:00', '17:00:00'),
(4, 2, 'Tuesday', '10:00:00', '18:00:00'),
(5, 2, 'Thursday', '10:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'CHRISTIAN ', 'MURAGWABUGABO', 'CHRISTIAN08', 'christian@gmail.com', '07999999999', '$2y$10$hv7WGP0tOwpgey2hfQ2BCe7GeAXoa1fYXXewwP1xhh.x4QTMz0B3S', '2024-05-16 13:47:33', '12', 0),
(2, 'MUTONI', 'grace', 'grace34', 'peacemutoni@gmail.com', '0734567890', '$2y$10$7on.rjTug.Y5oZ1fSzNe1epGMsJ2GH/.qiB5S3pSI.VAw70xniTwq', '2024-05-17 15:08:04', '98765', 0),
(3, 'irakoze', 'florence', 'foloirakoze', 'florenceirakoze@gmail.com', '07854345331', '$2y$10$NPA4aY8to6k88hAjLPv8WOiSsfnKx1CXjRrcgLKlBvwc1qWcLHuce', '2024-05-17 15:10:19', '6543', 0),
(4, 'kanyemera', 'kevin', 'kdb', 'kanyemerakevin@gmail.com', '07854443213', '$2y$10$WU6wfVP7qTccYEgFBY3xQe/RTz1HaskWc5kbD4g7iZsosXhTWAqsq', '2024-05-17 15:12:12', '98765', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `therapist_id` (`therapist_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `therapist_id` (`therapist_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `therapist_id` (`therapist_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `therapist_id` (`therapist_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `therapist_id` (`therapist_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `session_files`
--
ALTER TABLE `session_files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `therapist_id` (`therapist_id`);

--
-- Indexes for table `therapists`
--
ALTER TABLE `therapists`
  ADD PRIMARY KEY (`therapist_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `therapist_schedule`
--
ALTER TABLE `therapist_schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `therapist_id` (`therapist_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `session_files`
--
ALTER TABLE `session_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `therapists`
--
ALTER TABLE `therapists`
  MODIFY `therapist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `therapist_schedule`
--
ALTER TABLE `therapist_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`therapist_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`session_id`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`therapist_id`),
  ADD CONSTRAINT `notes_ibfk_3` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`therapist_id`),
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`session_id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`session_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`therapist_id`),
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`therapist_id`),
  ADD CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `session_files`
--
ALTER TABLE `session_files`
  ADD CONSTRAINT `session_files_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`session_id`),
  ADD CONSTRAINT `session_files_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `session_files_ibfk_3` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`therapist_id`);

--
-- Constraints for table `therapists`
--
ALTER TABLE `therapists`
  ADD CONSTRAINT `therapists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `therapist_schedule`
--
ALTER TABLE `therapist_schedule`
  ADD CONSTRAINT `therapist_schedule_ibfk_1` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`therapist_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
