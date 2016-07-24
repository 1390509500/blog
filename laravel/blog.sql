CREATE TABLE `bg_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `name` varchar(63) NOT NULL COMMENT '管理员名称',
  `pwd` varchar(255) NOT NULL COMMENT '管理员密码',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入记录的时间',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
insert into bg_admin values(null,'admin', ' eyJpdiI6InY0ZkY4N2t4dmhraW5xTDBFa3FqU1E9PSIsInZhbHVlIjoid0NjeWhmNkFRZEl5amVpRVpsVmpMQT09IiwibWFjIjoiNGYxZjdjZGY5ZGRiZTFjMWEzM2M0NDYyMTJjZDg2NDMyM2RhNzA0ZWMwZGI0OWU1NDUxZTQ3OWY2NzdiZjgwMiJ9',0,' 0000-00-00 00:00:00',' 0000-00-00 00:00:00');