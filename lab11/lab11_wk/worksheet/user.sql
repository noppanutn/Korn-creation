-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- ��ʵ�: localhost
-- ����㹡�����ҧ: 
-- ��蹢ͧ���������: 5.0.51
-- ��蹢ͧ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- �ҹ������: `hr`
-- 

-- --------------------------------------------------------

-- 
-- �ç���ҧ���ҧ `user`
-- 

CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `disable` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;