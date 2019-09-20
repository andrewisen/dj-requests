-- INSERT SOME TEST DATA --
use request;

INSERT INTO venue
  (name, description, open, close)
VALUES
  ('Nymble', 'Fetaste klubben på Östermalm', '22:00:00', '03:00:00'),
  ('MGs Hak', 'E de fezt?!', '00:00:00', '05:30:00');

INSERT INTO floor
  (name, description, genre, img, venueid)
VALUES
  ('Gröten', 'Dängor från förr!', 'Oldies, White Trash', '/groten.png', 1),
  ('Nya Matsalen', 'Stööök!', 'EDM', '/nya.jpeg', 1),
  ('Köket', 'Vågar du lyssna?', 'Nightcore', '/mg.png', 2);

INSERT INTO request
  (songid, artist, title, venueid, floorid, played)
VALUES
  ('6f54knyJHYJ1v6P591HPWU', 'Avicii', 'Levels - Radio Edit', 1, 2, 0),
  ('4m1lB7qJ78VPYsQy7RoBcU', 'Ben Rector', 'I Will Always Be Yours', 2, 1, 1),
  ('4m1lB7qJ78VPYsQy7RoBcU', 'Ben Rector', 'I Will Always Be Yours', 2, 1, 0),
  ('5HRV0yHL9ioy0FvEXbI8Xu', 'Avicii & Skrillex', 'Levels - Skrillex Remix', 2, 1, 0),
  ('44ADyYoY5liaRa3EOAl4uf', 'Miley Cyrus', 'Slide Away', 2, 1, 0),
  ('6f54knyJHYJ1v6P591HPWU', 'Avicii', 'Levels - Radio Edit', 1, 2, 0);
