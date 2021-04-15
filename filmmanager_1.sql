-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 30, 2020 lúc 05:46 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `filmmanager_1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('quy', '123456'),
('thanh', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `idcomment` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `phimcomment` int(11) NOT NULL,
  `noidung` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`idcomment`, `name`, `phimcomment`, `noidung`, `time`) VALUES
(8, 1, 39, 'abc', '2020-05-26 16:00:00'),
(11, 3, 12, 'hay', '2020-05-29 12:35:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietfilm`
--

CREATE TABLE `chitietfilm` (
  `idfilm` int(11) NOT NULL,
  `idtheloai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietfilm`
--

INSERT INTO `chitietfilm` (`idfilm`, `idtheloai`) VALUES
(10, 7),
(11, 1),
(12, 1),
(12, 8),
(12, 11),
(13, 1),
(13, 12),
(14, 1),
(14, 12),
(15, 1),
(15, 13),
(15, 14),
(16, 15),
(16, 16),
(16, 17),
(17, 18),
(17, 19),
(18, 12),
(19, 18),
(19, 19),
(20, 12),
(21, 1),
(21, 20),
(22, 19),
(22, 21),
(23, 22),
(24, 1),
(24, 5),
(25, 1),
(25, 5),
(26, 1),
(26, 5),
(27, 1),
(27, 5),
(28, 1),
(29, 1),
(29, 5),
(30, 1),
(30, 5),
(31, 23),
(31, 24),
(32, 5),
(33, 12),
(34, 1),
(34, 14),
(35, 1),
(35, 5),
(36, 1),
(36, 5),
(37, 1),
(37, 5),
(37, 25),
(38, 1),
(38, 5),
(38, 11),
(39, 1),
(39, 26);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietrating`
--

CREATE TABLE `chitietrating` (
  `idfilm` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `rating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietrating`
--

INSERT INTO `chitietrating` (`idfilm`, `iduser`, `rating`) VALUES
(11, 1, 4),
(13, 1, 5),
(18, 1, 5),
(18, 3, 5),
(24, 1, 4),
(24, 3, 5),
(25, 1, 4),
(33, 1, 2),
(33, 3, 3),
(35, 1, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `film`
--

CREATE TABLE `film` (
  `idfilm` int(11) NOT NULL,
  `tenfilm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dienvien` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thongtin` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thoiluong` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `namsx` year(4) NOT NULL,
  `sorating` float NOT NULL,
  `quocgia` int(11) NOT NULL,
  `daodien` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkfilm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `linktrailer` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `film`
--

INSERT INTO `film` (`idfilm`, `tenfilm`, `hinh`, `dienvien`, `thongtin`, `thoiluong`, `namsx`, `sorating`, `quocgia`, `daodien`, `linkfilm`, `linktrailer`) VALUES
(10, 'Parasite', 'img/1.jpg', 'Song Kang-ho, Lee Sun-kyun, Cho Yeo-jeong, Choi Woo-sik, Park So-dam', '“Ký Sinh Trùng” là bộ phim do đạo diễn Bong Joon-ho dàn dựng xoay quanh một gia đình nghèo. Gia đình này sống trong một căn hộ tồi tàn ở dưới tầng hầm một khu nhà cho thuê, điện thì bị cắt, chật vật chạy ăn từng bữa. Cho tới một ngày, người con trai lớn được giới thiệu làm gia sư tiếng Anh cho con gái của một gia đình giàu có. Choáng ngợp trước cơ ngơi của gia chủ, cậu bèn lên kế hoạch đưa cả gia đình mình thâm nhập vào ngôi nhà giàu có nhưng dễ tin người này, bắt đầu cuộc sống “ký sinh”.', '2', 2019, 5, 3, 'Bong Joon-ho', 'video/1.mp4', 'https://www.youtube.com/embed/SEUXfv87Wpk'),
(11, 'FANTASY ISLAND', 'img/2.jpg', 'Michael Peña, Maggie Q, Lucy Hale, Austin Stowell, Portia Doubleday, Jimmy O. Yang, Ryan Hansen, Michael Rooker', 'Câu chuyện về quý ngài Roarke và trợ lý Tatto, chào mừng các vị khách đến hòn đảo biệt lập của mình, và hứa hẹn 1 cuộc sống trong mơ.', '1', 2019, 4, 2, 'Jeff Wadlow', 'video/2.mp4', 'https://www.youtube.com/embed/a6O30nJ02PU'),
(12, 'FAST AND FURIOUS 9', 'img/3.jpg', 'Vin Diesel, Jordana Brewster, Charlize Theron, John Cena', 'Fast & Furious 9 tiếp tục những gì còn dang dở ở Fast & Furious 8 khi ả hacker Cipher kịp trốn thoát và nay tiếp tục nhắm đến gia đình Dominic Toretto (Vin Diesel) nhằm trả thù.', '2', 2020, 0, 2, 'Justin Lin', 'video/3.mp4', 'https://www.youtube.com/embed/_qyw6LC5pnE'),
(13, 'Train to Busan', 'img/4.jpg', 'Gong Yoo, Jung Yu-Mi, Ma Dong-Seok, Kim Soo-Ahn, Kim Eui-Sung, Choi Woo-Sik', 'đất nước Hàn bị tấn công bởi một loại virus bí ẩn, biến con người thành những xác sống hung hăng, khát máu. Có mặt trên chuyến tàu từ Seoul tới Busan là một người cha cùng con gái, hai vợ chồng chuẩn bị đón đứa con đầu lòng và một số cô cậu học sinh cấp 3. Khi đại dịch xác sống bất ngờ bùng phát, họ không còn cách nào khác ngoài đương đầu với nó để bảo vệ những người thân yêu của mình. Hành trình 453km từ Seoul tới vùng an toàn Busan bỗng trở thành cuộc chiến khốc liệt để sinh tồn', '1', 2016, 5, 3, 'Yeon Sang-Ho', 'video/4.mp4', 'https://www.youtube.com/embed/1ovgxN2VWNc'),
(14, 'TRAIN TO BUSAN 2', 'img/5.jpg', 'Kang Dong-won, Ava, Lee Ree, Koo Kyo-hwan, Kim Min-jae', 'Một thế giới bị bỏ hoang sau 4 năm kể từ Chuyến Tàu Sinh Tử được bao trùm bởi sợ hãi và chết chóc, luật chơi duy nhất là sống sót khỏi tận thế', '1', 2020, 0, 3, 'Yeon Sang-Ho', 'video/5.mp4', 'https://www.youtube.com/embed/7KcdzP5npZs'),
(15, 'Mission Impossible - Fallout', 'img/6.jpg', ' Rebecca Ferguson,Vanessa Kirby,Tom Cruise', 'Những kẻ địch lớn nhất thường quay trở lại để săn đuổi. Mission Impossible - Fallout với Ethan Hunt và nhóm IMF của anh cùng với các đồng minh trong một cuộc đua với thời gian sau khi nhiệm vụ thất bại.', '2', 2020, 0, 2, 'Christopher McQuarrie', 'video/6.mp4', 'https://www.youtube.com/embed/wb49-oV0F78'),
(16, 'BỐ GIÀ', 'img/7.jpg', 'Trấn Thành, NSND Ngọc Giàu, Lê Giang, Anh Đức, Tuấn Trần, Quốc Khánh, Uyển Ân', 'Bố già là phim hài tâm lý xã hội với câu chuyện của một gia đình của người đàn ông lái xe ôm. Ông thương vợ con, sống có trách nhiệm, thậm chí là nghĩa hiệp thái quá dù gia cảnh thiếu trước hụt sau. Song vì tính bảo thủ, khắt khe mà mâu thuẫn gia đình ông ngày càng căng thẳng, nhất là với cậu con trai như nước với lửa.', '2', 2019, 0, 1, 'Mr Tô', 'video/7.mp4', 'https://www.youtube.com/embed/rmPP-DRqEf0'),
(17, 'CUA LẠI VỢ BẦU', 'img/8.jpg', 'Trấn Thành, Ninh Dương Lan Ngọc, Anh Tú, Hữu Châu, Lê Giang, Trung Dân', 'Cua Lại Vợ Bầu là câu chuyện tình hoàn hảo của Trọng Thoại và Nhã Linh. Nhưng đời không như mơ khi người yêu cũ của Nhã Linh là Quý Khánh thình lình xuất hiện và gây nên hàng loạt xáo trộn trong trái tim cô gái.', '1', 2019, 0, 1, 'Nhất Trung', 'video/8.mp4', 'https://www.youtube.com/embed/JCa4bzzAGm4'),
(18, 'THẤT SƠN TÂM LINH', 'img/9.jpg', 'Quang Tuấn, Nguyễn Thanh Tú, Hoàng Yến Chibi, Đinh Y Nhung', 'Thất sơn tâm linh khai thác vụ án năm 2000 ở Đồng Tháp, khi gã thầy lang Hai Tưng (tên thật Phạm Văn Tuấn) muốn luyện bùa Thiên linh cái. Lợi dụng lòng tin của dân làng, hắn dụ một số cô gái đến sát hại.', '1', 2019, 5, 1, 'Lê Bình Giang', 'video/9.mp4', 'https://www.youtube.com/embed/uauBEGt1xXo'),
(19, 'Trót Yêu', 'img/10.jpg', 'Việt Trinh, Vũ Đức Hải, Khánh My, Hiếu Hiền', 'Bộ phim Trót Yêu về câu chuyện gia đình của Huy và Vy. Vì tiền tài danh vọng mà Huy đã lạc lối trót yêu cô trợ lý và bỏ rơi gia đình. Cuộc chiến của hai người phụ nữ ngấm ngầm bắt đầu, để giành lại người đàn ông mà họ đã trót yêu.', '1', 2015, 0, 1, 'Việt Trinh', 'video/10.mp4', 'https://www.youtube.com/embed/pQTVTQSbaRE'),
(20, 'Lời Nguyền Gia Tộc', 'img/11.jpg', 'Khương Ngọc, NSƯT Minh Châu, Tuấn Trần, Phi Huyền Trang', 'Nam bắt đầu chuyến hành trình bất ngờ tới vùng đất cao nguyên xa xôi và trải qua quãng thời gian trú ngụ đầy ám ảnh tại một căn biệt thư đã bị lãng quên giữa rừng. Những căn phòng nặng nề âm khí, những âm thanh kỳ lạ xuất hiện giữa đêm khuya, những bóng đen lẩn khuất trong các góc tối, nhưng phận người bí ẩn sinh sống quanh khu biệt thự, sự mất tích bất ngờ của An Nhiên – vợ chưa cưới của Nam...tất cả bủa vây khiến Nam hoảng loạn và sợ hãi.', '1', 2017, 0, 1, 'Đặng Thái Huyền', 'video/11.mp4', 'https://www.youtube.com/embed/OvBVH7-S8qc'),
(21, 'Không chiến Việt Nam - Những cánh én đầu tiên', 'img/12.jpg', 'Thái, Thanh', 'Tái hiện trận chiến trên Hàm Rồng ngày 4/4/1965, giữa lực lượng Không quân Nhân dân Việt Nam với lực lượng Không quân và Hải quân Mỹ. ', '1', 2019, 0, 1, 'Lê Nguyên Bảo', 'video/12.mp4', 'https://www.youtube.com/embed/gMEFcGYYpOo'),
(22, 'Nắng', 'img/13.jpg', 'Hoài Linh, Thu Trang, Trấn Thành, Kiều Minh Tuấn', 'Bé Nắng lanh lợi, đáng yêu sống cùng Trang – tên gọi thân thương là mẹ Mưa, một người mẹ bị thiểu năng, ngờ nghệch. Hàng ngày, hai mẹ con nương tựa nhau trong một căn nhà hoang, sống qua ngày bằng việc bán vé số và lượm ve chai.', '1', 2016, 0, 1, 'Đồng Đăng Giao', 'video/13.mp4', 'https://www.youtube.com/embed/tyaq_lOwqmg'),
(23, 'Tấm Cám Truyện Chưa Kể', 'img/14.png', 'Ngô Thanh Vân,Ninh Dương Lan Ngọc,Thành Lộc,Hữu Châu,Hạ Vi', 'Nước Việt thuở xưa được trị vì bởi 1 vị Vua anh minh nhưng đã tuổi cao sức yếu. Hoàng tử khôi ngô tuấn tú, thông minh tài trí nhưng càng lớn càng ham chơi. Trong khi đó, vị tể tướng Tào Hắc luôn lăm le cướp ngai vàng . Ngày nọ trên đường du xuân Hoàng Tử phải lòng Tấm & cưới nàng về làm Hoàng Hậu. Không lâu sau, Vua cha mất, triều đình rơi vào tay Tể Tướng, Hoàng Tử bị truy sát còn Tấm bị mẹ con Cám cùng Tể Tướng hại chết. Trải qua bao khó khăn và kiếp nạn, Hoàng Tử & những người bạn đã chiến đấu lấy lại ngai vàng, tìm lại người vợ hiền', '1', 2016, 0, 1, 'Ngô Thanh Vân', 'video/14.mp4', 'https://www.youtube.com/embed/sV0Dxq4EmhI'),
(24, 'Black Panther', 'img/15.jpg', 'Chadwick Boseman,Michael B. Jordan,Lupita Nyongo,Danai Gurira,Martin Freeman', 'Vương quốc Wakanda, quê hương của Black Panther/ TChalla hiện ra qua lời kể của một nhân chứng sống sót trở về. Đây là quốc gia khá khép kín và sở hữu lượng Vibranium lớn nhất trên thế giới. Black Panther - người cầm quyền của Wakanda sở hữu bộ áo giáp chống đạn và móng vuốt sắc nhọn, anh được miêu tả là “người tốt với trái tim nhân hậu”.', '2', 2018, 4.5, 2, 'Ryan Coogler', '	video/15.mp4', 'https://www.youtube.com/embed/xjDjIWPwcPU'),
(25, 'Doctor Strange', 'img/16.jpg', 'Benedict Cumberbatch, Chiwetel Ejiofor, Rachel McAdams, Benedict Wong, Michael Stuhlbarg, Benjamin Bratt, Scott Adkins, Mads Mikkelsen và Tilda Swinton.', 'DOCTOR STRANGE là câu chuyện về bác sĩ Giải Phẫu Thần Kinh tên Stephen Vincent Strange. Cuộc đời anh thay đổi từ sau một tai nạn xe hơi khủng khiếp. Sau tai nạn đó, Stephen nhận ra mình có những năng lực bí ẩn cũng như biết thêm về thế giới ma thuật huyền bí. Từ một vị bác sĩ bình thường, Stephen Strange dần nhận được nhiều siêu năng lực để cứu trái đất khỏi những tai họa.', '1', 2016, 0, 2, 'Scott Derrickson,', 'video/16.mp4', 'https://www.youtube.com/embed/HSzx-zryEgM'),
(26, 'Thor: Ragnarok', 'img/17.jpg', ' Chris Hemsworth,Mark Ruffalo,Tom Hiddleston', ' Phim Ragnarok 2017 ám chỉ “tận cùng của vũ trụ”, đồng nghĩa với trận chiến sống còn của 9 cõi (Nine Realms). Sau khi Loki Loki soán ngôi cha Odin, vị thần tinh quái này tiếp tục mở đường nhiễu loạn tiến từ cầu Bifrost vào trong Asgard. Thor sẽ phải trở về quê nhà để xử lí những sự kiện quan trọng. Điều này dẫn đến một cuộc chiến được so sánh với “ngày tận thế”', '2', 2017, 0, 2, 'Taika Waititi', 'video/17.mp4', 'https://www.youtube.com/embed/ue80QwXMRHg'),
(27, 'Logan', 'img/18.jpg', ' Hugh Jackman,Boyd Holbrook,Doris Morgado,Patrick Stewart,Elizabeth Rodriguez,Stephen Merchant,Julia Holt', ' Trong phim tuy không còn được như thời trẻ tuổi nhưng Wolverine vẫn tiếp tục chiến đấu với những ác nhân đột biến đang gây rối khắp nơi và điều còn đáng sợ hơn cả tuổi già của anh chính là sự cô độc trong những trận chiến vì đông đội của anh tất cả đã qua đời', '2', 2017, 0, 2, 'James Mangold', 'video/18.mp4', 'https://www.youtube.com/embed/Div0iP65aZog'),
(28, 'THE BLACKOUT: INVASION EARTH', 'img/19.jpg', 'Kỳ, Hiệp', 'Một hiện tượng không giải thích được đã xảy ra trên Trái đất. Liên lạc giữa hầu hết các thị trấn trên Trái đất đã bị cắt đứt. Một khu vực nhỏ ở Đông Âu là địa điểm duy nhất vẫn còn điện. Khi các lực lượng quân sự mạo hiểm ra bên ngoài, họ phát hiện ra một sự thật gây sốc - xác chết ở khắp mọi nơi. Trong các cửa hàng, trong xe hơi, trên đường, trong bệnh viện và nhà ga.', '1', 2020, 0, 2, 'James Abay', 'video/19.mp4', 'https://www.youtube.com/embed/DCAixCfVtfE'),
(29, 'Iron Man 3', 'img/20.jpg', 'Robert Downey Jr.,Guy Pearce,Gwyneth Paltrow', 'Khi thế giới bí mật của Stark bị phá hủy, anh quyết định dấn thân vào 1 cuộc hành trình khó khăn để tìm kẻ chủ mưu. Tony Stark sẽ phải chống lại những kẻ thù có sức mạnh vượt trội và không từ một thủ đoạn nào. Hơn thế nữa, chúng còn táo tợn tấn công, phá hủy thế giới riêng của anh, đồng thời khiến cho những người thân yêu nhất của Tony rơi vào vòng nguy hiểm.', '2', 2013, 0, 2, 'Shane Black', 'video/20.mp4', 'https://www.youtube.com/embed/muIsc5lIEyQ'),
(30, 'Captain America: The Winter Soldier', 'img/21.jpg', 'Scarlett Johansson,Sebastian Stan,Anthony Mackie,Cobie Smulders,Frank Grillo,Emily VanCamp,Hayley Atwell', 'Sau cuộc chiến cùng đội The Avengers tại New York, Captain America có một cuộc sống khá thầm lặng tại Washington và anh phải vật lộn để thích nghi với cuộc sông ở thế giới hiện đại. Tuy nhiên, khi một người bạn trong SHIELD bị rơi vào vòng nguy hiểm, anh đã bị kéo vào một âm mưu đen tối có thể phá hủy cả nhân loại. Cùng với Black Widow, anh phải ngăn cản âm mưu này đồng thời chiến đấu chống lại nhừng sát thủ chuyên nghiệp được cử tới để thủ tiêu mình.', '2', 2014, 0, 2, 'Anthony Russo,Joe Russo', 'video/21.mp4', 'https://www.youtube.com/embed/7SlILk2WMTI'),
(31, 'SHADOW', 'img/22.jpg', 'Deng Chao,Sun Li,Ryan Zheng Kai', 'Đại Đô Đốc Tử Ngu trong một lần chiến đấu đã bị thương nặng và phải ẩn thân trong bóng tối. Hắn giao phó cho sát thủ có tên Cảnh Châu, biệt hiệu “Ảnh tử”, để đạt được mưu đồ của riêng mình là lật đổ vương triều của vị vua nhu nhược, bất tài', '1', 2019, 0, 4, 'Zhang Yimou', 'video/22.mp4', 'https://www.youtube.com/embed/Zw3LjaZlSLM'),
(32, 'The Wheel', 'img/23.jpg', 'David Arquette, Jackson Gallagher', 'Thỉnh thoảng trong tương lai gần, trong một thế giới nơi các chính phủ và tổ chức xóa nhòa ranh giới giữa an ninh quốc gia và hành vi đạo đức,tù nhân bị phế truất Matt Mills gặp \"Hội đồng quản trị\". Dưới áp lực và với một lời hứa sẽ khiến anh ấy bước đi một lần nữa, Mills đồng ý tình nguyện cho chương trình của họ.Anh ta bị tiêm một vật liệu nano tổng hợp (N-B2C4B) và bị ngạt thở, chỉ thức dậy một mình trong một tế bào thép, với việc sử dụng đôi chân của mình - trong lần đầu tiên nói về một thiết bị thí nghiệm - Wheel ...', '1', 2019, 0, 2, 'Dee McLachlan ', 'video/23.mp4', 'https://www.youtube.com/embed/1CUUaftlpzk'),
(33, 'VENOM 2: CARNAGE', 'img/24.jpg', 'Tom Hardy, Woody Harrelson, Michelle Williams ', 'Chàng phóng viên Eddie Brock bí mật theo dõi âm mưu xấu xa của một tổ chức và bị nhiễm phải Symbiote và trở thành quái vật Venom đầy nguy hiểm', '1', 2020, 2.5, 2, 'Andy Serkis  ', 'video/24.mp4', 'https://www.youtube.com/embed/8cG1aVT-M-A'),
(34, 'JAMES BOND 007: NO TIME TO DIE', 'img/25.jpg', 'TDaniel Craig, Ana de Armas, Léa Seydoux.', 'No Time to Die là một bộ phim gián điệp sắp ra mắt và phần hai mươi lăm trong loạt phim James Bond do Eon Productions sản xuất. Phim có sự góp mặt của Daniel Craig trong chuyến đi chơi thứ năm và cuối cùng của anh với tư cách là điệp viên MI6 hư cấu James Bond', '2', 2020, 0, 2, 'Cary Joji Fukunaga ', 'video/25.mp4', 'https://www.youtube.com/embed/ixZc90cnhgM'),
(35, 'Avengers: Endgame', 'img/26.jpg', 'Josh Brolin,Chris Pratt,Chris Hemsworth', 'Sau sự kiện hủy diệt tàn khốc, vũ trụ chìm trong cảnh hoang tàn. Với sự trợ giúp của những đồng minh còn sống sót, biệt đội siêu anh hùng Avengers tập hợp một lần nữa để đảo ngược hành động của Thanos và khôi phục lại trật tự của vũ trụ', '3', 2019, 0, 2, 'Anthony Russo,Joe Russo', 'video/26.mp4', 'https://www.youtube.com/embed/TcMBFSGVi1c'),
(36, 'Star Wars: The Rise of Skywalker', 'img/27.jpg', 'Adam DriverAnthony DanielsBilly Dee WilliamsCarrie FisherDaisy RidleyDomhnall Gleeson', 'Chiến Tranh Giữa Các Vì Sao. “Skywalker Trổi Dậy” là hồi kết cuối cùng của thiên sử thi Skywalker, nơi những huyền thoại mới sẽ được lập ra và cuộc chiến giành tự do vẫn chưa ngả ngũ', '2', 2019, 0, 2, 'J. J. Abrams', 'video/27.mp4', 'https://www.youtube.com/embed/8Qn_spdM5Zg'),
(37, 'Mulan', 'img/28.jpg', 'Chung Tử Đơn, Lưu Diệp Phi, Lý Thiên Kiệt', 'Là một cô gái hiếu thảo, Hoa Mộc Lan thay cha mình tòng quân để bảo vệ đất nước. Phim được Disney chuyển thể từ tác phẩm hoạt hình ăn khách năm 1998. Nữ diễn viên nổi tiếng Lưu Diệc Phi đảm nhận vai diễn Mộc Lan', '2', 2020, 0, 4, 'Niki Caro', 'video/28.mp4', 'https://www.youtube.com/embed/KK8FHdFluOQ'),
(38, 'SPIDER-MAN 3: Home Run', 'img/29.jpg', 'Tom Holland, Samuel L.Jackson, Jake Gyllenhaal.', 'Là câu chuyên quay trở về của một cách mạnh mẽ của spider man với nhiều thử thách phải vượt qua', '0', 2021, 0, 2, 'Jon Watts', 'video/29.mp4', 'https://www.youtube.com/embed/akRHNEK_5is'),
(39, 'Extraction', 'img/30.jpg', 'Chris Hemsworth, Golshifteh Farahani, Randeep Hooda, Sam Hargrave', 'Nhiệm vụ của gã lính đánh thuê gan góc trở thành cuộc đua tìm lại chính mình để sống sót khi gã được phái đến Bangladesh để cứu con trai bị bắt cóc của một trùm ma túy.', '1', 2020, 0, 2, 'Sam Hargrave', 'video/30.mp4', 'https://www.youtube.com/embed/L6P3nI6VnlY');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khofilmyeuthich`
--

CREATE TABLE `khofilmyeuthich` (
  `idfilm` int(11) NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khofilmyeuthich`
--

INSERT INTO `khofilmyeuthich` (`idfilm`, `iduser`) VALUES
(12, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quocgia`
--

CREATE TABLE `quocgia` (
  `idquocgia` int(11) NOT NULL,
  `tenquocgia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quocgia`
--

INSERT INTO `quocgia` (`idquocgia`, `tenquocgia`) VALUES
(1, 'Việt Nam'),
(2, 'Mỹ'),
(3, 'Hàn Quốc'),
(4, 'Trung Quốc'),
(7, 'Úc'),
(8, 'Úc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `idtheloai` int(11) NOT NULL,
  `tentheloai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`idtheloai`, `tentheloai`) VALUES
(1, 'Phim hành động'),
(5, 'Phim Viễn Tưởng'),
(7, 'Hài kịch đen'),
(8, 'Hình sự'),
(9, 'Hài kịch đen'),
(10, 'Hình sự'),
(11, 'Phiêu lưu'),
(12, 'Kinh dị'),
(13, 'Mạo Hiểm'),
(14, 'Điệp viên'),
(15, 'Phim lẻ'),
(16, 'Gia đình'),
(17, 'Tầng lớp xã hội'),
(18, 'Tình cảm'),
(19, 'Tâm Lý'),
(20, 'Quân sự'),
(21, 'Xã hội'),
(22, 'Cổ tích'),
(23, 'Cổ Trang - Thần Thoại'),
(24, 'Võ Thuật - Kiếm Hiệp'),
(25, 'Drama'),
(26, 'Hồi hợp gây cấn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `tenuser` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`iduser`, `tenuser`, `username`, `password`) VALUES
(1, 'Phùng Thanh', 'thanh185', '1234567'),
(3, 'quy', 'quy', '123');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`idcomment`),
  ADD KEY `FK_USER` (`name`),
  ADD KEY `FK_FILM_BINHLUAN` (`phimcomment`) USING BTREE;

--
-- Chỉ mục cho bảng `chitietfilm`
--
ALTER TABLE `chitietfilm`
  ADD PRIMARY KEY (`idfilm`,`idtheloai`),
  ADD KEY `FK_FILM` (`idfilm`),
  ADD KEY `FK_THELOAI` (`idtheloai`) USING BTREE;

--
-- Chỉ mục cho bảng `chitietrating`
--
ALTER TABLE `chitietrating`
  ADD PRIMARY KEY (`idfilm`,`iduser`),
  ADD KEY `FK_FILM_RATING` (`idfilm`),
  ADD KEY `FK_USER_RATING` (`iduser`) USING BTREE;

--
-- Chỉ mục cho bảng `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`idfilm`),
  ADD KEY `FK_QUOCGIA` (`quocgia`);

--
-- Chỉ mục cho bảng `khofilmyeuthich`
--
ALTER TABLE `khofilmyeuthich`
  ADD PRIMARY KEY (`idfilm`,`iduser`),
  ADD KEY `FK_FILMYT_USER` (`idfilm`),
  ADD KEY `FK_USER_FILMYT` (`iduser`);

--
-- Chỉ mục cho bảng `quocgia`
--
ALTER TABLE `quocgia`
  ADD PRIMARY KEY (`idquocgia`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`idtheloai`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `idcomment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `film`
--
ALTER TABLE `film`
  MODIFY `idfilm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `quocgia`
--
ALTER TABLE `quocgia`
  MODIFY `idquocgia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `idtheloai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `FK_FILM_BINHLUAN` FOREIGN KEY (`phimcomment`) REFERENCES `film` (`idfilm`),
  ADD CONSTRAINT `FK_USER` FOREIGN KEY (`name`) REFERENCES `user` (`iduser`);

--
-- Các ràng buộc cho bảng `chitietfilm`
--
ALTER TABLE `chitietfilm`
  ADD CONSTRAINT `FK_FILM` FOREIGN KEY (`idfilm`) REFERENCES `film` (`idfilm`),
  ADD CONSTRAINT `FK_THELOAI` FOREIGN KEY (`idtheloai`) REFERENCES `theloai` (`idtheloai`);

--
-- Các ràng buộc cho bảng `chitietrating`
--
ALTER TABLE `chitietrating`
  ADD CONSTRAINT `FK_FILM_RATING` FOREIGN KEY (`idfilm`) REFERENCES `film` (`idfilm`),
  ADD CONSTRAINT `FK_USER_RATING` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);

--
-- Các ràng buộc cho bảng `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `FK_QUOCGIA` FOREIGN KEY (`quocgia`) REFERENCES `quocgia` (`idquocgia`);

--
-- Các ràng buộc cho bảng `khofilmyeuthich`
--
ALTER TABLE `khofilmyeuthich`
  ADD CONSTRAINT `FK_FILMYT_USER` FOREIGN KEY (`idfilm`) REFERENCES `film` (`idfilm`),
  ADD CONSTRAINT `FK_USER_FILMYT` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
