<?php

// 该upload只是作为一个例子 具体情况请根据自身应用进行修改
date_default_timezone_set('PRC');
define( 'UPLOAD_PATH', 'upload/' );
define( 'ALLOW_EXT', 'png|jpg|jpeg|gif|bmp|doc|rar|zip' );
define( 'UPLOAD_DISABLED', FALSE );

$current_url = getCurrentURL();
function getCurrentURL() {
    return 'http://' . $_SERVER['HTTP_HOST'] . dirname( $_SERVER['PHP_SELF'] ) . '/';
}

// 异常捕获
$error = NULL;
// 执行父窗口的插入文件
$autoInsertFile = NULL;
try {
    if ( !is_dir( UPLOAD_PATH ) && !@mkdir( UPLOAD_PATH ) ) throw new Exception( '上传目录不存在' );
    if ( !is_writeable( UPLOAD_PATH ) ) throw new Exception( '请确保目录可写' );

    // 上传
    function do_upload() {
        global $current_url, $autoInsertFile;
        if ( isset( $_FILES['MDE_file'] ) && is_uploaded_file( $_FILES['MDE_file']['tmp_name'] ) ) {
			if ( UPLOAD_DISABLED ) {
				$autoInsertFile = $current_url . UPLOAD_PATH . 'test.png';
				return;
			}
			
            $filename = $_FILES['MDE_file']['name'];
            $fileext = array_pop( explode( '.', $filename ) );
            if ( !preg_match( '/' . ALLOW_EXT . '/', $fileext ) ) throw new Exception( '上传文件类型不合法' );
            move_uploaded_file( $_FILES['MDE_file']['tmp_name'], UPLOAD_PATH . $filename );
            $autoInsertFile = $current_url . UPLOAD_PATH . $filename;
        }
    }
    do_upload();

    // 读取目录下的文件
    $handle = opendir( UPLOAD_PATH );
    $all_files = array();
    while( $file = readdir( $handle ) ) {
        if ( $file != '.' && $file != '..' ) $all_files[] = $file;
    }
    closedir( $handle );

    // 按照日期先后排序
    function sortFileByDate( $a, $b ) {
        $atime = filemtime( UPLOAD_PATH . $a );
        $btime = filemtime( UPLOAD_PATH . $b );
        if ( $atime == $btime ) return 0;
        return ( $atime > $btime ) ? -1 : 1;
    }
    usort( $all_files, 'sortFileByDate' );

} catch( Exception $e ) {
    $error = $e->getMessage();
}


?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body>
    <?php if( isset( $error ) && $error ) { ?>
    <div><?php echo $error; ?></div>
    <?php } else { ?>
    <ul>
        <?php foreach( $all_files as $file ) { ?>
        <li>
            <a href="javascript:parent.MDE_insertFile('<?php echo $current_url . UPLOAD_PATH . $file; ?>');"><?php echo $file; ?></a> 
            <span><?php echo filesize( UPLOAD_PATH . $file ) / 1000; ?>kb</span>
            <span><?php echo date('Y-m-d H:i:s', filemtime( UPLOAD_PATH . $file )); ?></span>
        </li>
        <?php } ?>
    </ul>
        <?php if( isset( $autoInsertFile ) && $autoInsertFile ) { ?>
        <script>parent.MDE_insertFile( '<?php echo $autoInsertFile; ?>' );</script>
        <?php } ?>
    <?php } ?>
</body>
</html>

