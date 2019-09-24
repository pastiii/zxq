<?
#修改配置
vim /etc/docker/daemon.json

#json内容
#配置多个仓库地址一逗号连接 例如:"harbor.test.com","registry.cn-shenzhen.aliyuncs.com"
{
    "insecure-registries":["121.199.53.9:5000"]
}

#启用配置
systemctl daemon-reload
systemctl restart docker

#拉取镜像
docker pull 121.199.53.9:5000/apm-ubuntu:1.2.1

#运行镜像
docker run -id --name apm -v /usr/local/apm:/usr/local/apm 121.199.53.9:5000/apm-ubuntu:1.2.1 /bin/bash

#重启
/etc/init.d/cron stop
/etc/init.d/cron start




#安装docker
#清除老旧docker
sudo yum remove docker \
                  docker-client \
                  docker-client-latest \
                  docker-common \
                  docker-latest \
                  docker-latest-logrotate \
                  docker-logrotate \
                  docker-selinux \
                  docker-engine-selinux \
                  docker-engine


#安装系统工具
sudo yum install -y yum-utils device-mapper-persistent-data lvm2

#添加软件原信息
sudo yum-config-manager --add-repo http://mirrors.aliyun.com/docker-ce/linux/centos/docker-ce.repo

#添加yum缓存
sudo yum makecache fast

#安装
sudo yum -y install docker-ce

#启动
sudo systemctl start docker

docker service create --replicas 4 -p 8888:80 --name nginx nginx:latest
docker service ps nginx

yum install -y https://download.docker.com/linux/centos/7/x86_64/stable/Packages/docker-ce-19.03.2-3.el7.centos.x86_64.rpm
wget https://download.docker.com/linux/centos/7/x86_64/stable/Packages/docker-ce-19.03.2-3.el7.centos.x86_64.rpm


docker service create --replicas 3 --name nginx --network web-bi --detach=false -p 8888:80 nginx
docker network create --driver overlay web-bi


#rpm安装docker
#下载docker rpm包
wget -P /tmp https://mirrors.aliyun.com/docker-ce/linux/centos/7/x86_64/stable/Packages/docker-ce-cli-19.03.2-3.el7.x86_64.rpm

#安装docker
yum install -y /tmp/docker*.rpm && rm -f /tmp/docker*.rpm

mkdir /etc/dockerecho '{"registry-mirrors":["https://registry.docker-cn.com"]}' > /etc/docker/daemon.json