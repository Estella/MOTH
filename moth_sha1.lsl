string MOTH(string s) {
  integer utime = llGetUnixTime();
  integer len = (llStringLength((string)utime) - 2);
  string code = llGetSubString((string)utime, 0, len);
  return llSHA1String(llMD5String(code+s,(integer)code)+s);
}
