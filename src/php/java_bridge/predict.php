<?php header( 'Content-Type: text/html; charset=UTF-8' );

define("JAVA_DEBUG", true); //调试设置
define("JAVA_HOSTS", "127.0.0.1:8080"); //设置javabridge监听端口
/*0: Log nothing, not even fatal errors.
  1: Log fatal system errors such as "out of memory error".
  2: Log java exceptions.*/
define("JAVA_LOG_LEVEL", 2); //java.log_level: 0-6

require_once "Java.inc"; //php调用java的接口，与该脚本位于同一目录
java_set_file_encoding("UTF-8"); //设置JAVA编码。

try {
  /* invoke java.lang.System.getProperties() */
  $props = java("java.lang.System")->getProperties();
  
  /* convert the result object into a PHP array */
  $array = java_values($props);
  foreach($array as $k=>$v) {
    echo "$k=>$v"; echo "<br>\n";
  }
  echo "<br>\n";
  
  /* create a PHP class which implements the Java toString() method */
  class MyClass {
    function toString() { return "hello PHP from Java!"; }
  }
  
  /* create a Java object from the PHP object */
  $javaObject = java_closure(new MyClass());
  echo "PHP says that Java says: "; echo $javaObject;  echo "<br>\n";
  echo "<br>\n";






  echo java("php.java.bridge.Util")->VERSION; echo "<br>\n";

} catch (JavaException $ex) {
  echo "An exception occured: "; echo $ex; echo "<br>\n";
}
try{    
	  $Des3 = new Java("Main"); //实例
	  // $Des3->Main.hi();
	      echo "<hr>";
}
catch(Exception $e) {
    echo($e);
}
?>
