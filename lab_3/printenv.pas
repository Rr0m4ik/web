PROGRAM PrintEnvironmentVariables(INPUT, OUTPUT);

USES
  DOS;

VAR
  RequestMethod: String;
  QueryString: String;
  ContentLength: String;
  UserAgent: String;
  Host: String;

BEGIN {PrintEnvironmentVariables}
  WRITELN('Content-Type: text/plain');
  WRITELN; // Пустая строка между заголовком и телом ответа

  // Получаем значения переменных окружения
  RequestMethod := GetEnv('REQUEST_METHOD');
  QueryString := GetEnv('QUERY_STRING');
  ContentLength := GetEnv('CONTENT_LENGTH');
  UserAgent := GetEnv('HTTP_USER_AGENT');
  Host := GetEnv('HTTP_HOST');

  // Выводим значения переменных окружения
  WRITELN('REQUEST_METHOD: ', RequestMethod);
  WRITELN('QUERY_STRING: ', QueryString);
  WRITELN('CONTENT_LENGTH: ', ContentLength);
  WRITELN('HTTP_USER_AGENT: ', UserAgent);
  WRITELN('HTTP_HOST: ', Host)
END. {PrintEnvironmentVariables}
