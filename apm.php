<?
#修改配置
vim /etc/docker/daemon.json

#json内容
{
    "insecure-registries":["121.199.53.9:5000"]  #配置多个仓库地址一逗号连接 例如:"harbor.test.com","registry.cn-shenzhen.aliyuncs.com"
}

#启用配置
systemctl daemon-reload
systemctl restart docker

#拉取镜像
docker pull 121.199.53.9:5000/apm-ubuntu:latest

#重启
/etc/init.d/cron stop
/etc/init.d/cron start



