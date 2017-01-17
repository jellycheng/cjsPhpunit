
/**********test_user_db****************/

/**用户表*/
CREATE TABLE `t_user` (
  `iAutoID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sUserName` varchar(30) DEFAULT '',
  `sNickname` char(40) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `sRealname` char(10) NOT NULL DEFAULT '' COMMENT '姓名',
  `sMobile` char(40) NOT NULL DEFAULT '' COMMENT '手机号',
  `sPassword` char(60) NOT NULL DEFAULT '' COMMENT '用户密码',
  `iStatus` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `iCreateTime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `iUpdateTime` int(11) NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  PRIMARY KEY (`iAutoID`),
  KEY `login` (`sMobile`,`sPassword`,`iStatus`) USING BTREE,
  KEY `sNickname` (`sNickname`),
  KEY `iCreateTime` (`iCreateTime`),
  KEY `sMobile` (`sMobile`,`iStatus`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=30472611 DEFAULT CHARSET=utf8 COMMENT='用户基本信息表';

