DELIMITER $$
DROP procedure IF EXISTS `insert_modulos` $$
CREATE PROCEDURE `insert_modulos` ()
BEGIN
    DECLARE a INT;
    set a= 1;
    simple_loop: LOOP         
        INSERT INTO dataset.tb_modulo (nome) VALUES (concat('módulo ', a));
        SET a=a+1;
        IF a > 12 THEN
            LEAVE simple_loop;
        END IF;
    end loop;
END;$$
call insert_modulos()$$
drop procedure insert_modulos$$

DROP procedure IF EXISTS `insert_videos_1` $$
CREATE PROCEDURE `insert_videos_1` ()
BEGIN
    DECLARE m INT;
    DECLARE v INT;
    set m = 0;
    
    WHILE m < 4 DO 
        SET m = m + 1;        
        set v = 0;
        WHILE V < 118 DO 
			SET v = v + 1;
            INSERT INTO dataset.tb_video (
                id_modulo, 
                num_video,
                nome, 
                caminho_video, 
                caminho_legenda) 
            VALUES (m, v,
                    concat('vídeo ', v, ' do módulo ', m), 
                    concat('/videos/grupo', m, '/', v, '.mp4'), 
                    concat('/legendas/grupo', m, '/', v, '.vtt'));
		END WHILE;
	END WHILE;
END;$$
call insert_videos_1()$$
drop procedure insert_videos_1$$

DROP procedure IF EXISTS `insert_videos_2` $$
CREATE PROCEDURE `insert_videos_2` ()
BEGIN
    DECLARE m INT;
    DECLARE v INT;
    set m = 4;    
    WHILE m < 8 DO 
        SET m = m + 1;
        set v = 0;
        WHILE V < 118 DO 
			SET v = v + 1;
            INSERT INTO dataset.tb_video (
                id_modulo, 
                num_video,
                nome, 
                caminho_video, 
                caminho_legenda) 
            VALUES (m, v,
                    concat('vídeo ', v, ' do módulo ', m), 
                    concat('/videos/grupo', m, '/', v, '.mp4'), 
                    concat('/legendas/grupo', m, '/', v, '.vtt'));
		END WHILE;
	END WHILE;
END;$$
call insert_videos_2()$$
drop procedure insert_videos_2$$

DROP procedure IF EXISTS `insert_videos_3` $$
CREATE PROCEDURE `insert_videos_3` ()
BEGIN
    DECLARE m INT;
    DECLARE v INT;
    set m = 8;
    WHILE m < 12 DO 
        SET m = m + 1;
        set v = 0;
        WHILE V < 118 DO 
			SET v = v + 1;
			INSERT INTO dataset.tb_video (
                id_modulo, 
                num_video,
                nome, 
                caminho_video, 
                caminho_legenda) 
            VALUES (m, v,
                    concat('vídeo ', v, ' do módulo ', m), 
                    concat('/videos/grupo', m, '/', v, '.mp4'), 
                    concat('/legendas/grupo', m, '/', v, '.vtt'));
		END WHILE;
	END WHILE;
END;$$
call insert_videos_3()$$
drop procedure insert_videos_3$$
DELIMITER ;