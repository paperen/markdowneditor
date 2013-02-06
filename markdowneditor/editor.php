<?php

$do = isset( $_GET['do'] ) ? $_GET['do'] : '';
if ( $do == 'parse' ) {
    $content = stripslashes( $_POST['content'] );
    $html = MarkdownEditor::parse( $content );
    $result = array(
        'html' => $html,
        'raw' => htmlspecialchars( $html ),
    );
    echo json_encode( $result );
    exit;
}

class MarkdownEditor
{
    static public function jquerySupported() {
        $js = <<<EOT
<script>if (typeof (jQuery) == 'undefined') {document.write(unescape("%3Cscript src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'%3E%3C/script%3E"));}</script>
EOT;
        echo $js;     
    }

    static private function HTML( $config ) {
        $html = "
            <div class=\"markdown_editor\">
            <textarea id=\"MDE_textarea\">{$config['value']}</textarea>
            <textarea name=\"{$config['name']}\" id=\"{$config['id']}\" style=\"display:none;\">{$config['value']}</textarea>
            <div id=\"MDE_preview\" style=\"display:none;\"></div>
            <input type=\"button\" id=\"MDE_insertlink_btn\" value=\"插入链接\">";
        if ( $config['preview'] ) $html .= "<input type=\"button\" id=\"MDE_preview_btn\" value=\"预览\">";
        if ( $config['upload'] ) $html .= "<input type=\"file\" name=\"MDE_file\" for=\"MDE_file_form\" id=\"MDE_file\">
            <input type=\"button\" id=\"MDE_filesubmit_btn\" value=\"上传文件\" for=\"MDE_file_form\">
            <div><iframe frameborder=\"no\" id=\"MDE_upload_iframe\" name=\"MDE_upload_iframe\" src=\"{$config['upload_handler']}\" border=\"none\"></iframe></div>
</div>";
        echo $html;
    }

    static private function JS( $config ) {
        $js = <<<EOT
<script>
var LINK_KEY = 65,
PREVIEW_KEY = 80,
UPLOAD_KEY = 85,
TAB_KEY = 9,
upload_path = '{$config['upload_path']}',
upload_handler = '{$config['upload_handler']}',
id = '{$config['id']}',
name = '{$config['name']}',
editor_relpath = '{$config['editor_relpath']}',
preview = '{$config['preview']}',
upload = '{$config['upload']}'
;
</script>
<script src="{$config['editor_relpath']}editor.js"></script>
EOT;
        echo $js;
    }

    // init Config
    static private function initConfig( $config ) {
        $defaultConfigs = array(
            'editor_relpath' => './markdowneditor/',   // markdown编辑器相对路径
            'id' => 'content',  // 编辑器ID
            'name' => 'content',    // 编辑器名称
            'value' => '',
            'preview' => TRUE,  // 开启预览
            'upload' => TRUE,   // 开启上传文件
            'upload_path' => './upload/',   // 文件上传保存目录
            'upload_handler' => './upload/upload.php',  // 文件上传处理器
        );
        $validConfigs = array_merge( $defaultConfigs, $config );
        $defaultConfigsKeys = array_keys( $defaultConfigs );
        foreach( $validConfigs as $k => $v ) {
            if ( !in_array( $k, $defaultConfigsKeys ) ) unset( $validConfigs[$k] );
        }
        return $validConfigs;
    }

    // render markdown editor
    static public function render( $config ) {
        $config = self::initConfig( $config );
        self::jquerySupported();
        self::HTML( $config );
        self::JS( $config );
    }

    static public function parse( $content ) {
        require_once( 'core.php' );
        return markdown( $content );
    }
}
