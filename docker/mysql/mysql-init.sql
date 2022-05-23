CREATE DATABASE crud_db;

USE crud_db;

CREATE TABLE haiku(
    id INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    author VARCHAR(50) NOT NULL,
    content VARCHAR(255)
);

INSERT INTO haiku(author,title,content) VALUES
(
'Matsuo Basho','The Old Pond','An old silent pond 
A frog jumps into the pond — 
Splash! Silence again.'
),
(
'Kobayashi Issa','A World of Dew','A world of dew,
And within every dewdrop
A world of struggle.'
),
(
'Yosa Buson','Lighting One Candle','The light of a candle
Is transferred to another candle —
Spring twilight'
),
(
'Natsume Soseki','Over the Wintry','Over the wintry
Forest, winds howl in rage
With no leaves to blow.'
);