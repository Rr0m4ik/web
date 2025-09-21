PROGRAM Greeting(INPUT, OUTPUT);

USES
  DOS;

VAR
  QueryString, Name: STRING;
  PosName: INTEGER;

BEGIN {Greeting}
  WRITELN('Content-Type: text/plain');
  WRITELN; // Пустая строка между заголовком и телом ответа

  QueryString := GetEnv('QUERY_STRING');
  PosName := Pos('name=', QueryString);

  IF PosName > 0 THEN
  BEGIN
    Name := Copy(QueryString, PosName + Length('name='), Length(QueryString));
    WRITELN('Hello dear, ', Name, '!');
  END
  ELSE
    WRITELN('Hello Anonymous!');
END. {Greeting}
