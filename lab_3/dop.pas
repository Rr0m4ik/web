PROGRAM WorkWithQueryString(INPUT, OUTPUT);

USES
  DOS;

FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  QueryString, ParamName, ParamValue: STRING;
  StartPos, EndPos, EqualPos: INTEGER;
BEGIN
  { Initialize the result to an empty string }
  GetQueryStringParameter := '';

  { Retrieve the QUERY_STRING from environment variables }
  QueryString := GetEnv('QUERY_STRING');

  { If QUERY_STRING is not empty, proceed with parsing }
  IF QueryString <> '' THEN
  BEGIN
    { Find the start position of the key=value pair }
    StartPos := POS(Key + '=', QueryString);

    IF StartPos > 0 THEN
    BEGIN
      { Calculate the position of '=' after the key }
      EqualPos := StartPos + LENGTH(Key) + 1;

      { Find the end position of the value (either '&' or the end of the string) }
      ParamValue := Copy(QueryString, EqualPos, MAXINT); { Extract everything after '=' }
      
      { Look for '&' to determine the end of the value }
      EndPos := POS('&', ParamValue);
      
      IF EndPos > 0 THEN
      BEGIN
        { If '&' is found, truncate the value up to '&' }
        ParamValue := Copy(ParamValue, 1, EndPos - 1);
      END;

      { Return the extracted value }
      GetQueryStringParameter := ParamValue;
    END;
  END;
END;

BEGIN {WorkWithQueryString}
  WRITELN('Content-Type: text/plain');
  WRITELN; { Blank line to separate headers from body }

  { Print the results for 'first_name', 'last_name', and 'age' }
  WRITELN('First Name: ', GetQueryStringParameter('first_name'));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name'));
  WRITELN('Age: ', GetQueryStringParameter('age'));
END. {WorkWithQueryString}
