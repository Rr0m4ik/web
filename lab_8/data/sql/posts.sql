INSERT INTO
    users (id, username, avatar_src, about)
VALUES
    (
        1,
        'Ваня Денисов',
        '../src/images/Avatar_1.png',
        'Привет! Я системный аналитик в ACME :)'
    ),
    (
        2,
        'Лиза Дёмина',
        '../src/images/Avatar_2.png',
        'Люблю путешествовать и делиться впечатлениями!'
    );

INSERT INTO
    posts (
        id,
        user_id,
        image,
        description,
        like_count,
        created_at
    )
VALUES
    (
        1,
        1,
        '../src/images/Photo_1.jpg',
        'Так красиво сегодня на улице!\nНастоящая зима))\nВспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне, в городке, занесенном снегом по ручку двери…',
        203,
        FROM_UNIXTIME (1743554061)
    ),
    (
        2,
        2,
        '../src/images/Photo_2.png',
        'Пост от Лизы',
        69,
        FROM_UNIXTIME (1743554061)
    );