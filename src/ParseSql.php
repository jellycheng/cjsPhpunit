<?php
namespace CjsPhpunit;

class ParseSql {

    public static function parseSql($sqlText, $tblPre = null)
    {
        if(!is_null($tblPre)) {
            $sqlText = str_replace(' `tbl_', ' `'.$tblPre, $sqlText);
        }
        $sqlText = str_replace(["\r\n", "\r"], "\n", $sqlText);
        $ret=array(); //存放sql语句
        // 多行注释标记
        $isMoreComment = false;
        $num=0;
        foreach(explode(";\n",trim($sqlText)) as $query)
        {//分割sql
            $ret[$num] = '';
            $queries=explode("\n",trim($query));
            foreach($queries as $line)
            {//处理每一行
                // 跳过空行
                if ($line == '') {
                    continue;
                }
                if(self::isSqlZhuShi($line)) {
                    continue;
                }
                // 多行注释开始
                if (substr($line, 0, 2) == '/*') {
                    $isMoreComment = true;
                    continue;
                }
                // 多行注释结束
                if (substr($line, -2) == '*/') {
                    $isMoreComment = false;
                    continue;
                }
                // 多行注释没有结束，继续跳过
                if ($isMoreComment) {
                    continue;
                }
                $ret[$num] .= $line;

            }
            $num++;

        }

        return $ret;

    }


    public static function sqlType($sql){
        $sql_chars = explode(' ', trim($sql), 2);
        if(empty($sql_chars[0])) {
            return '';
        }
        $types = array(
                        'SELECT','INSERT','UPDATE','DELETE',
                        'REPLACE','RENAME','SHOW','SET','DROP',
                        'EXPLAIN','CREATE',
                        'DESCRIBE');
        if(!in_array(strtoupper($sql_chars['0']),$types)) {
            return strtoupper($sql_chars['0']);
        }
        return '';
    }


    public static function isSqlZhuShi($content)
    {
        $content = trim($content);
        // 跳过以#或者--开头的单行注释
        if (preg_match("/^(#|--)/", $content)) {
            return true;
        }
        // 跳过以/**/包裹起来的单行注释
        if (preg_match("/^\/\*(.*?)\*\//", $content)) {
            return true;
        }

        return false;
    }


}