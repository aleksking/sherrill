-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2015 at 01:03 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_common_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `additionalinfo`
--

CREATE TABLE IF NOT EXISTS `additionalinfo` (
  `id` int(11) NOT NULL,
  `n_id` bigint(20) NOT NULL,
  `nid` bigint(20) NOT NULL,
  `moveindate` text,
  `tobebuilt` text,
  `masterbadroom` varchar(255) NOT NULL,
  `hottubs` tinyint(4) NOT NULL DEFAULT '0',
  `golf` tinyint(4) NOT NULL DEFAULT '0',
  `resort_property` tinyint(4) NOT NULL DEFAULT '0',
  `waterview` tinyint(4) NOT NULL DEFAULT '0',
  `waterfront` tinyint(4) NOT NULL DEFAULT '0',
  `newhome` tinyint(4) NOT NULL DEFAULT '0',
  `city_water` tinyint(4) NOT NULL DEFAULT '0',
  `city_sweer` tinyint(4) NOT NULL DEFAULT '0',
  `electricity` tinyint(4) NOT NULL DEFAULT '0',
  `well` tinyint(4) NOT NULL DEFAULT '0',
  `water_coop` tinyint(4) NOT NULL DEFAULT '0',
  `showmap` tinyint(4) NOT NULL DEFAULT '0',
  `septic_tank` tinyint(4) NOT NULL DEFAULT '0',
  `citylimit` tinyint(4) NOT NULL DEFAULT '0',
  `etj` tinyint(4) NOT NULL DEFAULT '0',
  `road_access` tinyint(4) NOT NULL DEFAULT '0',
  `flood_plain` tinyint(4) NOT NULL DEFAULT '0',
  `minreals_convey` tinyint(4) NOT NULL DEFAULT '0',
  `will_divide` tinyint(4) NOT NULL DEFAULT '0',
  `fenced` varchar(100) DEFAULT NULL,
  `soil` varchar(100) DEFAULT NULL,
  `ag_exemption` tinyint(4) NOT NULL DEFAULT '0',
  `cross_fenced` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ntreislist_id` bigint(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=399957 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE IF NOT EXISTS `agents` (
  `id` int(11) NOT NULL,
  `agent_license_no` text NOT NULL,
  `Name` varchar(200) NOT NULL,
  `email_address` text NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `agent_id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `Agent_link` text NOT NULL,
  `agent_desc` text NOT NULL,
  `officephone` varchar(255) DEFAULT NULL,
  `metro1` varchar(255) DEFAULT NULL,
  `metro2` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `tollfree` varchar(255) DEFAULT NULL,
  `pager` varchar(255) DEFAULT NULL,
  `voicemail` varchar(255) DEFAULT NULL,
  `home_phone` varchar(255) DEFAULT NULL,
  `agent_offcode` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=425 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `agent_license_no`, `Name`, `email_address`, `phone_number`, `agent_id`, `photo`, `Agent_link`, `agent_desc`, `officephone`, `metro1`, `metro2`, `fax`, `tollfree`, `pager`, `voicemail`, `home_phone`, `agent_offcode`) VALUES
(202, '123', 'joie', 'joie_angel2002@yahoo.com', '111-111-1111', 123, 'imgres.png', '', '', '', '', '', '', '', '', '111-111-1111-1111', '111-111-1111', 'treo_101'),
(40, '430130', 'Ginger Lina', 'brokersre@verizon.net', '979-540-7353', 0, 'imgres.png', '', '', '', '', '', '979-773-4511', '', '', '', '', '4204'),
(41, '17080', 'Travis McPhaul', 'brokersre@verizon.net', '979-716-2325', 0, 'imgres.png', '', '', '', '', '', '979-773-4511', '', '', '', '', '4204'),
(42, '17766', 'Misty Schumpert', 'mistylina@hotmail.com', '979-540-7356', 0, 'imgres.png', '', '', '', '', '', '979-773-4511', '', '', '', '', '4204'),
(43, '18276', 'Pratt Homes', 'lpratt@lpratthomes.com', '', 18276, '', 'http://www.lpratthomes.com', '310 A SSE Loop 323   Tyler, TX 75702', '', '', '', '', '', '', '', '', '1362'),
(52, '0499274', 'B. RAY ARMAND', 'armand2718@att.net', '817-800-8291', 18200, 'B. RAY ARMAND.png', '', 'Affiliations: Greater Fort Worth Association of REALTORSï¿½, North Texas Real Estate Information Systems, Texas Association of REALTORSï¿½, REALTORï¿½, National Association of REALTORSï¿½', '', '', '', '', '', '', '', '', ''),
(44, '1000', 'bob', 'sales@greatinnovus.com', '', 1000, '', 'http://greatinnovus.com', 'This is test account....', '', '', '', '', '', '', '', '', '1000'),
(2, '3362', 'Leon Westfall', 'leon@westfallrealestate.com', '979-540-0401', 0, 'imgres.png', '', 'As the firms senior partner, Leon Westfall possesses a wealth of knowledge in the area of farming, ranching and rural properties in Lee County. Leon served the needs of farmers and ranchers in Lee County for over 36 years while serving with the Department of Agriculture. With his knowledge of property location, soil types, stocking rates and conservation practices Leon continues to be a great asset for the clients of Westfall Real Estate\r\n\r\n', '', '', '', '979-542-0078', '', '', '', '', '1209'),
(3, '3363', 'Doug Westfall', 'doug@westfallrealestate.com', '979-540-0404', 0, 'imgres.png', '', 'Broker Doug Westfall brings a great deal of practical experience and knowledge of Giddings and Lee County to this real estate firm. A native of Giddings, Doug served as a local Banker for more than 10 years where he saw real estate transactions from the lender’s, seller’s and buyer’s point of view. This experience and unique prospective is of great benefit to the clients of Westfall Real Estate. Doug is also a dedicated community servant working with or providing leadership over the years to such organizations as; First Baptist Church of Giddings, Giddings Economic Development Corp., Giddings Area Chamber of Commerce, Rotary Club of Giddings, Giddings Independent School District, Lee County Little League and the Giddings Optimist Club Soccer and Little Dribblers Programs.', '', '', '', '979-542-0078', '', '', '', '', '1209'),
(5, '0518630', 'CHARLEY THOMAS', 'charleythomas@valornet.com', '254-396-0067', 18260, 'imgres.png', '', 'CHARLEY HAS BEEN A PROPERTY OWNER AND RESIDENT OF SOMERVELL COUNTY FOR OVER TEN YEARS AND INVOLVED IN REAL ESTATE BROKERAGE FOR EIGHT YEARS. HE PRACTICED PUBLIC ACCOUNTING IN AN INTERNATIONAL C P A FIRM AND OWNED HIS OWN FIRM FOR ABOUT 40 YEARS.. ALSO, HE IS EXPERIENCED IN MAKING "DEALS" WORK WHILE COUNSELING CLIENTS AND OTHERS. CHARLEY PRACTICES GIVING GREAT SERVICES TO HIS CLIENTS NO MATTER HOW LARGE OR SMALL A TRANSACTION MIGHT BE. GIVE HIM AN OPPORTUNITY TO WORK WITH YOU. WE BELIEVE YOU WILL BE PLEASED.', '', '', '', '254-897-2716', '', '', '254-396-0067-', '254-897-7289', 'JPR00GB'),
(6, '0186874', 'John Pruitt', 'pruittre@valornet.com', '254-898-3045', 2331, 'imgres.png', 'http://www.htcomp.net/pruittrealty', 'BROKER-FOURTH GENERATION SOMERVELL COUNTY RESIDENT.  BAT FROM SAM HOUSTON STATE UNIVERSITY, CLASS OF 1971.  FORMER CITY COUNCILMAN AND MAYOR PRO TEAM, MEMBER OF THE CHAMBER OF COMMERCE-LOCAL AND NATIONAL MEMBER OF THE NRA-GOLDEN EAGLES, GLEN ROSE OPTIMIST CLUB, NFIB, TEXAS AND SOUTH WESTERN CATTLE RAISERS ASSOC.,AND LISTED IN THE WHO’S WHO NATIONAL REGISTRY. LICENSED REAL ESTATE AGENT SINCE 1972.  ASSISTED IN OVER 300 REAL ESTATE SALES TOTALING ALMOST $50 MILLION IN REAL ESTATE TRANSACTIONS.\r\nWIFE- KATHY PRUITT IS A TEACHER AT GLEN ROSE ISD AND WE HAVE TWO CHILDREN- CLAY AND MEGAN.  \r\nPARTNER WITH FATHER BILL PRUITT IN PRUITT LAND CATTLE CO. AND OPERATES THEIR RANCH LOCATED ON HIGHWAY 144 BETWEEN WALNUT SPRINGS AND MERIDIAN IN BOSQUE COUNTY.', '', '', '254--2417', '254-897-2716', '', '', '', '', 'JPR00GB'),
(7, '0410885', 'Linda Schoessow', 'ljschoessow@yahoo.com', '254-897-1858', 18233, 'imgres.png', '', 'Linda Schoessow  -  Realtor\r\n\r\nI moved here in 1979 with my husband and children from the metroplex. I was employed with TXU for 5 years, First Financial bank for 5 years, and currently have been a Real Estate agent for over 20 years. I have been involved with school projects,community events, volunteer work,member of the Chamber of Commerce and past Secretary for the Ambassadors of Glen Rose.I am proud to say all 5 of my children have graduated from the GRISD.One is attending his last stretch at Graduate School in the Houston area. The twins graduated from Tarleton with Computer Degrees,one married  in the Metroplex,one in Arkansas at Walmart head office. My daughter & family lives here in Glen Rose , a RN at the Cleburne Hospital, and my oldest son a Sales Rep live in Cleburne with his wife and daughter. I love being a member of this great communuity and really enjoy the people who make it what it is - A GREAT PLACE TO LIVE !', '', '', '', '254-897-2716', '', '', '', '254-897-1858', 'JPR00GB'),
(8, '2448', 'Gene Crouch', 'genecrouch@grandecom.net', '512-376-1480', 0, 'imgres.png', '', '', '512-398-5814', '512-376-5814', '', '512-376-5814', '', '', '', '512-398-3591', '1154'),
(9, '17395', 'Christy Stephens', 'genecrouch@grandecom.net', '512-376-0045', 0, 'imgres.png', '', '', '512-398-5814', '512-376-5814', '', '512-376-5814', '', '', '', '512-398-5665', '1154'),
(10, '267943', 'Judith Matula', 'porjam@aol.com', '512-760-5440', 267943, 'http://pudowensrealty.com/wp-content/uploads/amerisale-re/1369410595.jpg', '', '', '', '', '', '512-446-4273', '', '', '', '', '4296'),
(12, '604661', 'Monique Gebhart', 'moniquegebhart@gmail.com', '512-269-8865', 18254, 'agent_1341637511.jpg', '', '', '', '', '', '512-446-4273', '', '', '512-446-4243-', '512-446-5697', '4296'),
(13, '611369', 'Tomm Owens', 'porjam@aol.com', '', 0, 'agent_1346790082.png', '', '', '', '', '', '512-446-4273', '', '', '', '', '4296'),
(14, '617167', 'Robbie Breithaupt', 'porjam@aol.com', '512-574-8818', 0, 'imgres.png', '', '', '', '', '', '512-446-4273', '', '', '', '', '4296'),
(15, '301884', 'Evelyn Bauerschlag', 'porjam@aol.com', '512-760-6235', 0, 'imgres.png', '', '', '', '', '', '512-446-4273', '', '', '', '', '4296'),
(16, '590015', 'Pete Bega', 'pbega1@yahoo.com', '', 18262, 'imgres.png', '', '', '', '', '', '512-281-9608', '', '', '', '', '072M'),
(17, '318703', 'Jeanette Shelby', 'jeanetteshelby@yahoo.com', '', 1084, 'imgres.png', '', '', '', '', '', '', '', '', '', '', '072M'),
(18, '496418', 'Sandy Smith', 'sandysmithrealtor@gmail.com', '', 16819, 'me12062011.jpg', '', '', '', '', '', '512-281-9608', '', '', '', '', '072M'),
(19, '3187', 'Georgeena Arnett', 'Bexley@bluebon.net', '979-542-6167', 0, 'imgres.png', '', '', '', '', '', '979-773-4930', '', '', '', '', '4332'),
(20, '219021', 'Margaret Bexley', 'Bexley@bluebon.net', '', 3210, 'imgres.png', '', '', '', '', '', '979-773-4930', '', '', '', '', '4332'),
(21, '3123', 'Bexley Real Estate', 'Bexley@bluebon.net', '', 0, 'imgres.png', '', '', '', '', '', '979-773-4930', '', '', '', '', '4332'),
(30, '17228', 'Reynolds Joe Boyd', 'joeboydreynolds@verizon.net', '979-540-0308', 0, 'ai17228_2212711.jpg', '', 'Joe Boyd Reynolds is a life time resident of Lee County.  He has over 20 years experience in the Real Estate Field.  Joe is a singer and a song writer and leads the JBR Band performing all over Texas and locally.  Joe Boyd has a vast knowledge of Lee and the surrounding counties and his experience is a real plus to Mayer Realty and Associates.  Joe Boyd works in and out of the office seven days a week and will work nights and weekends to help you accomplish your real estate needs.  Give Joe Boyd a call for any and all of your real estate needs. In addition Joe is an accomplished country singer and band leader.  Check out his website and hear his songs @ jbrband1.tripod.com/ .  Enjoy!', '', '', '', '979-542-1715', '', '', '', '', '1054'),
(28, '17192', 'Jason B. Keaghey', 'jkeaghey@hotmail.com', '979-540-8340', 0, 'imgres.png', '', 'Jason Keaghey began working for Mayer Realty & Associates in 2005. He brings an energy and enthusiasm to the office that us older agents can only observe and admire. Jason’s passion and ability to accommodate the needs of customers and clients is unprecedented. Jason is based out of Giddings and specializes in Lee County property, but also regularly reaches out to the counties of Bastrop, Burleson, Washington, Fayette, Travis, Milam, Colorado, Caldwell, Austin, Williamson and others upon request. He is extremely versatile and has experience listing and selling all types of property. He handles commercial, residential, farm & ranch, unimproved property, and will also manage your property if desired. Jason works nights, weekends, and is even willing to work holidays to help you with your real estate needs. Contact Jason by phone or e-mail at your convenience and he will be pleased to assist you in regards to selling your property or locating the most suitable property possible.', '979-542-2696', '979-542-2554', '', '979-542-1715', '', '', '', '', '1054'),
(31, '1267', 'Jeffrey B. Keaghey', 'keagheymayer@aol.com', '979-542-8236', 0, 'imgres.png', '', 'Co-owner and broker, Jeffrey B. Keaghey joined Mayer Realty in 1979, as a salesman. In 1985, he opened his own office, Keaghey Real Estate and operated it until rejoining Mayer Realty in August of 1994, when the two firms jointly negotiated a sale of land which included his office to Brookshire Bros. The new store now sits on this site, and is one of the finest in the area. Jeff is married to the former Judy Kay Keng of Giddings. They have two children, Corrie, presently a nurse, wife and mother, and Jason, who has graduated from the Giddings Independent School District. Jeff, and his family are members of the Martin Luther Lutheran Church of Giddings. Jeff, was familiar with the city of Giddings at an early age due to his father, Mr.. W.O. Keaghey serving as Giddings City manager back in the 1960''s.\r\n\r\nJeff holds a B.A.. Degree in real estate from Blinn College in addition to taking specialized appraisal courses through Texas A & M and Deane Business College. Mr. Keaghey is a candidate for membership with the National Association of Fee Appraisers and is also qualified to testify as an expert witness. Since 1979, Jeff has appraised or inspected approximately 1200 rural and residential properties in the Central Texas Area. He has sold properties in Lee, Bastrop, Burleson, Washington & Fayette County over the past 16 plus years and is well acquainted with the values, property, and good folks that reside there.\r\n\r\nJeff has served on the Board of Directors of the Giddings Country Club where he enjoys many good games of golf. He also is a past member of the Giddings Lions Club & is past Grand Master of the J. D. Giddings Lodge # 280. Jeff is a definite asset both to Mayer Realty and to the community.', '979-542-2554', '979-542-2696', '', '979-542-1715', '', '', '', '', '1054'),
(32, '18256', 'Jacqueline Kuehn', 'kuehnj1@yahoo.com', '979-716-9540', 0, 'imgres.png', '', '', '', '', '', '', '', '', '', '', '1054'),
(35, '17193', 'Tommy Jackson', 'ronyn_lynzi@hotmail.com', '979-542-6847', 0, 'imgres.png', '', '', '', '', '', '', '', '', '', '', '1054'),
(36, '17333', 'Garry C. Brown', 'garry@garrybrownrealestate.com', '979-540-6700', 0, 'imgres.png', '', '', '', '', '', '979-773-2816', '', '', '', '', '1326'),
(37, '17334', 'Lindsay Brown', 'lindsay@garrybrownrealestate.com', '', 0, 'imgres.png', '', '', '', '', '', '979-773-2816', '', '', '', '', '1326'),
(39, '18267', 'LaScott Wood Dylla', 'lascottdylla@gmail.com', '254-482-0287', 0, 'imgres.png', '', '', '', '', '', '', '', '', '', '', '1326'),
(49, '0443430', 'RANDEL "Rees" ATKINS', 'Rees4home@aol.com', '817-980-8321', 16388, 'RANDEL Rees ATKINS.png', 'http://www.reesandpiperteam.com', 'Rees brokered commercial properties from 1983 to 1994 becoming active in the residential real estate market in July of 1995. Rees has been the top producing real estate agent in Parker County since 1998. In 2000 Rees and Piper felt the need to provide a higher level of service to their customers and concepted the "Rees and Piper" team in which two top producing Brokers could use their unique specialties to provide a higher level of service than any single agent could provide. Results of this partnership have been unsurpassed with team sales exceeding every other agent or team in Parker County with over 35 million dollars in real estate sold in 2006. The Rees and Piper Team are ranked in the top 3 in the state and in the top 25 in the nation in the Century 21 system.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(135, '0329792', 'STACY LYNCH', 'SLynch@c21lynch.com', '817-908-9567', 329792, 'Stacy.New.3.jpg', 'www.lynchlegacygroup.com', '', '', '', '', '817-441-7932', '', '', '', '', 'LYNC00FW'),
(158, '99999999', 'sdfsdfsdf', 'sdfsdfsdf@yahoo.com', '999-999-9999', 99999999, 'imgres.png', '', '', '999-999-9999', '999-999-9999', '999-999-9999', '999-999-9999', '999-999-9999', '999-999-9999', '999-999-9999-9999', '999-999-9999', 'treo_654321'),
(51, '0604698', 'RYAN ATKINS', 'ryancatkins81@gmail.com', '817-296-2679', 18265, 'Ryan Atkins.png', '', 'Ryan attended Aledo High School and then went on graduate from the University of North Texas with a bachelor’s degree in hospitality business management. He started his career in the investment side of real estate in early 2010. He joined Century 21 Lynch and Associates in September of 2011.\r\n\r\nRyan lives in Aledo with his better half and two children. They are members at Willow Park Baptist Church and active in Aledo youth athletics.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(102, '18278', 'Robert Kuehn', 'Mayerrealty@Usa.Net', '979-540-6414', 0, 'imgres.png', '', '', '', '', '', '', '', '', '', '', '1054'),
(103, '17137', 'Billy Higgins', 'billyhiggins1@verizon.net', '512-332-6069', 0, 'imgres.png', '', '', '', '', '', '', '', '', '', '', '1054'),
(54, '0616988', 'SHARON BRUTON', 'sbrutonintexas@yahoo.com', '817-565-6227', 18268, 'Sharon Bruton.png', '', 'Affiliations: Greater Fort Worth Association of REALTORS®, North Texas Real Estate Information Systems, Texas Association of REALTORS®, REALTOR®, National Association of REALTORS®', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(55, '0576264', 'PAUL TERPENING', 'paul.terpening@CENTURY21.com', '817-304-8666', 17921, 'Paul Terpening.png', '', 'Knowledge is power!\r\nWhether you are a first time buyer or a seasoned veteran at buying and selling homes, please allow me to make buying or selling your home a pleasurable experience. My pledge is to provide every customer honesty, loyalty, and dedication. I remember the wonderful yet traumatic experience of buying my first home. I have also experienced the buying and selling of homes since. Having an honest, open, and skilled real estate professional made each transaction enjoyable.\r\n\r\nI have served in the military of our great country and have enjoyed a career as a teacher, principal, and school superintendent. I hold post graduate degrees in education, finance, and school district administration. Looking for someone to guide you through buying or selling your property? Please give me a call.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(56, '0602328', 'STEVE BUCKLAND', 'sbuckland1958@ymail.com', '817-235-1442', 18249, 'Steve Buckland.png', 'http://www.myparkercountyhome.com', 'Hello! My name is Steve Buckland and I am a licensed Real Estate agent with Century 21 Lynch & Associates. I was born in San Antonio, Texas and so I claim “Native” Texan status although I have only lived in this great state for the past 30 years. My father was in the Air Force and so I was constantly on the move when I was a kid. I’ve lived in Oklahoma, Kansas, Idaho, Washington (State), Ohio, Kentucky, and in due time here in Texas. I became a Real Estate Agent a year ago and have loved this profession. Why? Well, because it gives me a chance to help people during a very confusing time in their lives - when they are buying or selling a home. I am committed to customer service first and foremost. That means I’m going to look out for your best interests. I will be with you and there for you from beginning to end -- and then even after that. My phone is always on and I take calls from clients and customers anytime day or night. I will work as hard as I can to make sure that we chase away your Real Estate blues.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(57, '0467686', 'SHEILA SWAN', 'sheilacentury21@hotmail.com', '817-703-2267', 15251, 'Sheila Swan.png', 'http://www.SheilaSwan.com', 'Experience:\r\nCENTURY 21 Lynch & Associates, Texas\r\nStan Wiley Prudential Real Estate, Oregon\r\nHillcrest Realtors, Indiana\r\n\r\nAffiliations:\r\nREALTOR, National Association of REALTORS\r\nGreater Fort Worth Board of Realtors\r\nTexas Association of Realtors\r\nNorth Texas Real Estate Information Systems\r\n\r\nHobbies:\r\nDancing, NASCAR, Bowling', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(58, '0551521', 'RAYMOND BURR', 'raymond.burr@CENTURY21.com', '817-996-1952', 17483, 'RAYMOND BURR.png', '', 'Raised in Fort Worth, I moved to Weatherford in 1993. Here I found the big city conveniences with the down home small town appeal. Parker County is growing in leaps and bounds, and being a part of it is exciting and rewarding.\r\n\r\nTo help a young couple with their first home or to be a part of finding that special dream house, are just some of the more rewarding experiences of being a Realtor. It most definitely is a privilege and responsibility to be a part of something so important in peoples’ lives.\r\n\r\nMy life has truly been blessed. From my wonderful wife of over 20 years to my beautiful daughter, and loving parents half a century wed. Through those I love grows a strength within that sustains and inspires me. Life’s true rewards do not come with a price tag, and sometimes just listening can make all the difference.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(59, '0339623', 'JERRY STOCKON', 'JerryC21@aol.com', '817-371-6776', 15241, '1339529346.jpg', '', 'Experience:\r\nI have successfully sold real estate in the Aledo, Willow Park area since 1983. I have maintained a million dollar producer status every year. Since 1995 I have been the Top Selling agent & Volume Producer. In 1997 I became part owner of CENTURY 21 Lynch & Associates. Thank you for allowing me to serve you.\r\n\r\nAffiliations:\r\nI am currently a member of the Greater Fort Worth Association of REALTORS®, North Texas Real Estate Information Systems, Texas Association of REALTORS®, REALTOR®, National Association of REALTORS® and the East Parker County Chamber of Commerce.\r\n\r\nEducation:\r\nI graduated from Aledo High School in 1983 with honors. I went on to receive my Associates degree in business and a bachelors degree in Finance and Real Estate at UTA. I have had CENTURY 21 Plus and VIP® referral training.\r\n\r\nHobbies:\r\nSome of my hobbies include hunting, fishing, jogging, and bee-keeping.\r\n\r\nVision:\r\nI provide a wide range of services that other agents are unable to provide. My emphasis is on satisfied customers. My objective in my real estate career is to create lasting business relationships. My level of commitment is proof that I am in this business for the long-run.\r\n\r\nCENTURY 21 Lynch and Associates  has served the community for more than 40 Years.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(61, '0492025', 'THOM SMITH', 'ThomSmithC21@aol.com', '817-829-9598', 17490, 'THOM SMITH.png', 'http://www.BridgettSmith.com', 'Business Owner\r\n\r\nDegrees and Licenses:\r\nB. S. Criminal Justice\r\nTarelton State University 1989-1993\r\n\r\nReal Estate Membership:\r\nGreater Fort Worth Board of Realtors\r\nTexas Association of Realtors\r\nNorth Texas Real Estate Information Systems\r\nREALTOR, National Association of REALTORS\r\n\r\nHobbies:\r\nTraveling, Hunting, Fishing, and Family Time', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(62, '0456972', 'CAROL DETHERAGE', 'cd8901@att.net', '817-980-4204', 15244, 'Carol Detherage.png', '', 'Experience:\r\n1996 to present:\r\nReal Estate Agent specializing in single family,\r\nfarm & ranch, and land sales.\r\nAledo Postmaster for 27 years.\r\n\r\nAffiliations:\r\nREALTOR, National Association of REALTORS\r\nGreater Fort Worth Board of Realtors\r\nNorth Texas Real Estate Information Systems\r\n\r\nCommunity:\r\nI have lived in Parker County all my life.\r\n\r\nPersonal:\r\nI have three children: Mike, Debbie and Nick.\r\nI enjoy hunting, fishing, and travel.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(63, '0479149', 'BRIDGETT SMITH', 'BridgettSmithC21@aol.com', '817-829-9020', 15264, 'Bridgett Smith.png', 'http://www.BridgettSmith.com', '#1 Agent in Parker County in Units Sold, 2001\r\n2001-2008 CENTURION® Producer\r\n2001 Top 21 - CENTURY 21 Western Division\r\nMillion Dollar Producer\r\n\r\nDegrees, Certifications & Lisences:\r\nBachelor of Arts Degree in English & Biological Sciences Tarleton State University 1990-1994\r\nTexas Teacher Certification - Secondary Biology\r\nTexas Teacher Certification - Secondary Physical Sciences\r\n\r\nReal Estate Membership:\r\nGreater Fort Worth Board of Realtors\r\nTexas Association of Realtors\r\nNorth Texas Real Estate Information Systems\r\nREALTOR, National Association of REALTORS\r\n\r\nHobbies:\r\nTraveling and Spending Time With My Family', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(64, '0159787', 'ROBERT DUVALL', 'robertduvall1940@gmail.com', '817-313-1984', 18244, 'Robert Duvall.png', '', 'Robert is a native of Parker County and has been in real estate for 14 years, specializing in farm & ranch, residential and commercial.\r\n\r\nRobert is a retired educator and administrator having spent 30 years in the field. He was a farmer & rancher in northwest Parker County most of his life. He and his wife Linda now live near Weatherford and have two grown children. They are active members of Aledo United Methodist Church.\r\n\r\nRobert has served as a director on Campbell Hospital Board, Tri County Electric Coop, Brazos Electric and San Miguel Electric.\r\n\r\nI feel very fortunate to get the opportunity to join the CENTURY 21 Lynch & Associates team in Willow Park.\r\n\r\nI would like to thank all my past & present clients and look forward to serving them and others through the CENTURY 21 Lynch & Associates office.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(65, '0558782', 'SAM FERONTI', 'samuel.feronti@CENTURY21.com', '817-905-8023', 17431, 'SAM FERONTI.png', '', 'Experience:\r\n10 Years sales experience in International Business.\r\nExecutive Quality Management\r\n\r\nAffiliations:\r\nGreater Fort Worth Association of Realtors\r\nNorth Texas Real Estate Information Systems\r\nTexas Association of Realtors\r\nREALTOR, National Association of REALTORS\r\n\r\nEducation:\r\nBrewer High School 1983\r\nUniversity of North Texas\r\nUniversity of Texas -Arlington- Real Estate\r\n\r\nHobbies:\r\nGolf, Hunting, Fishing.\r\n\r\nVision:\r\nThe customer is most important.\r\nI must continually strive to exceed their expectations.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(66, '0410661', 'KEITH FULTON', 'keithdfulton@hotmail.com', '817-925-3016', 18241, 'Keith Fulton.png', '', 'Keith believes in giving great customer service and in doing so, wants to develop a relationship that last well past your closing.\r\n\r\nGiving back to communities is important to Keith. He has been a member of the Rotary Club of Western Fort Worth for 18 years and is a past president.\r\n\r\nKeith is an avid horseman and golfer as well as 19 years as a REALTOR® with CRS and GRI accreditation.\r\n\r\nThis Aledo resident is waiting to meet you!', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(68, '0532700', 'PAULA HARDIN JUNKERT', 'Phardin56@yahoo.com', '682-553-4283', 18242, 'Paula Hardin.png', '', 'Paula is originally from Abilene and has had several assorted careers before she decided to become a full time real estate professional in Parker County. She has always worked with the public and therefore knows customer service. She has been a business owner, and has worked in various other positions that have enhanced her ability to work with buyers and sellers in all walks of life. She always put her clientsï¿½ needs first with integrity, trust, honesty and flexibility.\r\n\r\nPersonal:\r\nHas two grown sons and three Grandchildren.\r\n\r\nInterests:\r\nSpending time with family and Grandchildren, anything outdoors, camping, hunting,\r\n\r\nTop producer in years 2006 and 2007\r\nMember of North Side Baptist Church, Weatherford\r\n\r\nAffiliations:\r\nGreater Metro West Association of Realtors\r\nGreater Fort Worth Association of Realtors\r\nNational Association of Realtors\r\nTexas Association of Realtors\r\nNorth Texas Real Estate Information Systems', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(69, '0577911', 'WHITNEY HARRIS', 'Whitney.Harris@CENTURY21.com', '817-360-5381', 18004, 'Whitney.Pack.Harris.JPG', 'http://www.whitneyharris.com', 'Experience;\r\nSince getting my real estate license in the summer of 2007, I have been actively participating the sales, leasing and managing of commercial properties. I am currently managing over 500,000 sq. ft. of office/warehouse spaces in Fort Worth, Southlake, Allen, Dallas, Austin and Houston. I am also involved quite a bit in the new construction of homes. I help my husband with his custom home business here in Aledo.\r\n\r\nAffiliations:\r\nREALTOR, National Association of REALTORS\r\nMember of Greater Fort Worth Association of Realtors\r\nMember of North Texas Real Estate Information Systems\r\nMember of the Texas Association of Realtors\r\n\r\nEducation:\r\nI graduated from Aledo High School in 2000. Then in August of 2004 I received a bachelor’s degree in Business Management from Tarleton State University.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(113, '0549807', 'JODI RUDEL', 'JodiRudelC21@yahoo.com', '817-614-4020', 17404, 'JODI RUDEL.png', '', 'Hello , my name is Jodi Rudel and my registered partner is Paul Scharbach.\r\n\r\nWe are one of the most effective and experienced Real Estate teams in Tarrant and Parker counties.\r\n\r\nOur Real Estate family "CENTURY 21 Lynch & Associates" is the number one Real Estate company in Parker county.\r\n\r\nPaul and I are very diverse in meeting ALL your Real Estate needs from Homes to Commercial to Ranches whether it be listing or purchasing , we strive for perfection in your satisfaction.\r\n\r\nWe are also part of the Colonial Savings F.A. family as we represent them in their Repo needs here and across the country.\r\n\r\nOur professional services are just a call away, making your Real Estate transaction satisfying and memorable.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(276, '625661', 'JAD BENBARKA', 'Jad@tonyaaron.com', '', 99999, 'imgres.png', '', '', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(279, '325388', 'TONY AARON', 'Tony@tonyaaron.com', '817-992-6338', 99999, 'tonypic.JPG', 'www.tonyaaron.com', '', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(136, '82', 'rhrth', 'fksm@gbrdhg.vfdh', '', 53853, 'imgres.png', '', '', '42-245-5252', '525-525-2525', '525-525-2525', '525-252-2252', '', '', '', '', ''),
(137, '123465', 'test agent', 'test@yahoo.com', '', 123443, 'imgres.png', '', '', '', '', '', '', '', '', '', '', ''),
(155, '8888888', 'test3', 'test3@yahoo.com', '888-888-8888', 8888888, 'imgres.png', '', '', '888-888-88', '888-888-8888', '888-888-8888', '888-888-8888', '777-777-7777', '777-777-7777', '888-888-8888-8888', '888-888-8888', 'treo_654321'),
(280, '217957', 'Clara Sherrill', 'Sherrill_real_estate@yahoo.com', '', 217957, 'imgres.png', '', '', '', '', '', '', '', '', '', '', '6676'),
(189, '222222222222', 'Randy', 'info@hvvvvvvvvvvvvvvvealthygrid.com', '614-360-1222', 222222222, 'http://publicfusion.com/treo/wp-content/uploads/amerisale-re/1355750583.png', '', '', '', '', '', '614-360-1222', '614-360-1222', '', '', '', 'treo_216'),
(120, '0520512', 'TJ HOTCHKIN', 'tj.hotchkin@CENTURY21.com', '817-726-7798', 17486, 'TJ HOTCHKIN.png', '', 'Affiliations: Greater Fort Worth Association of REALTORSÂ®, North Texas Real Estate Information Systems, Texas Association of REALTORSÂ®, REALTORÂ®, National Association of REALTORSÂ®', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(74, '0555439', 'GARY HUNTER', 'glhunter1@yahoo.com', '817-480-7681', 18252, 'Gary Hunter.png', '', 'Hello, Whether you are new to the market, thinking of moving up, or an experienced investor, I have the expertise, proven track record, and resources to assist you in your next purchase or to sell your current home. Knowledge of the area, care, loyalty,and personal concern for my clients combine to make me the best choice to assist you in your next real estate transaction. I work relentlessly to help you meet your real estate needs and goals.\r\n\r\nIf you are interested in selling your house or land, or buying a new home, I will meet with you to discuss my proven marketing plans and present a comparative market analysis, at no cost to you. My main goal at CENTURY 21 Lynch & Associates is to provide the most professional and ethical service to you and to our community. I pledge to make buying or selling real estate an enjoyable experience for you.\r\n\r\nPlease feel free to contact me by email or phone anytime you would like to ask questions or to see property. I would be more than happy to assist you in any way possible to meet your real estate needs. Thank you and I look forward to assisting you. GaryHunter\r\n\r\nShort Sales and Foreclosures Resource / SFR REALTORS® with the SFR certification can be a trusted resource for short sales and foreclosures.\r\n\r\nTAHS Texas Affordable Housing Specialist', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(75, '0502812', 'BART LARGENT', 'Bart.Largent@CENTURY21.com', '817-798-3756', 17019, 'BART LARGENT.png', '', 'Affiliations:\r\nGreater Fort Worth Association of Realtors\r\nTexas Association of Realtors\r\nNorth Texas Real Estate Information Systems\r\nREALTOR, National Association of REALTORS\r\n\r\nMission:\r\nWhether you are new to the market, thinking of moving up, or you’re an experienced investor, I have the expertise, proven track record, and resources to help you buy or sell your next home. Enthusiasm, knowledge of the area and personal concern for the clients interest combine to make me an outstanding resource for your real estate transaction. I work extensively to help buyers and sellers meet their real estate goals. \r\n\r\nIf you are interested in selling your house or land, I’ll meet with you to discuss my proven marketing plan and present a comparative market analysis at no cost.\r\n\r\nMy goal at Century 21 Lynch & Associates is to provide a professional and ethical service to the community. I hope to make buying or selling real estate a pleasent experience for my clients.\r\n\r\nPlease feel free to contact me if you have any questions or real estate needs that you have. I’m available at times that are convenient to you. Thank you for this opportunity and I look forward to assisting you.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(77, '0174827', 'JAN LYNCH', 'jlynch@c21lynch.com', '817-441-8059', 16875, 'JAN LYNCH.png', 'http://www.c21Lynch.com', 'Experience:\r\nRealtor from 1971 to the present Realtor Broker for Lynch & Associates Realty 1997 franchisied with CENTURY 21 Corporation and now know as CENTURY 21 Lynch & Associates\r\n\r\nAffiliations:\r\nGreater Fort Worth Association of Realtors\r\nTexas Association or Realtors\r\nNorth Texas Real Estate Information Systems\r\nREALTOR, National Association of REALTORS\r\n\r\nCommunity:\r\nResident of the Aledo Willow Park area for 32 years Past Board Member of the Parker County Association of Realtors\r\n\r\nPersonal:\r\nMarried to Roy Lynch, co owner & designated Broker for CENTURY 21 Lynch & Associates Four Children Ten Grandchildren', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(80, '551756', 'Kerry Bexley', 'snowsbbq@yahoo.com', '979-542-8189', 219021, 'imgres.png', '', '', '', '', '', '', '', '', '', '', '4332'),
(81, '554165', 'Jordan Bexley', 'bexley@bluebon.net', '979-540-9734', 219021, '', '', '', '', '', '', '979-773-4930', '', '', '', '', '4332'),
(82, '533599', 'Keith Bexley', 'bexley@bluebon.net', '512-217-1952', 219021, '', '', '', '', '', '', '979-773-4930', '', '', '', '', '4332'),
(101, '1265', 'Rudy Mayer', 'mayerrealty@usa.net', '979-716-3148', 0, 'imgres.png', '', 'Rudy A. Mayer is Co-Owner and a sales associate at Mayer Realty & Associates. Rudy has been involved in sales for the greater part of his life. He first moved to Giddings in 1969 after attending Immanuel Lutheran School for some time. He is a Graduate of Giddings High School. His history with farm machinery & real estate sales is well known throughout Central Texas. Rudy acquired his real estate sales license in the early 70''s. His expertise is not only in marketing, sales promotion and advertising but in making a deal work, once it is reduced to paper. Available financing is a very necessary tool in making any deal work. Rudy is proud of the fact that the has been able to obtain for buyers, some of the best mortgage financing in the Central Texas Area by working with local area lenders and mortgage companies.\r\n\r\nIn addition to his involvement with Mayer Realty & Associates, Rudy is a members of the Martin Luther Lutheran Church of Giddings. He has 6 children and 2 grandchildren. In the past, he has served on the Church Counsel, various positions in the Men in Mission, and Sunday School. Rudy holds insurance and securities licenses of various types, and is an active Texas Auctioneer as licensed under the laws of the State of Texas. He is also an Associate member of the National Association of Master Appraisers and National Association of Counselors.\r\n\r\nCivic involvements currently include being an active member of the Giddings Volunteer Fire Department where he attended a large number of calls last year. In addition, he is very involved as a member of the local Giddings Chamber of Commerce Ambassador Club, Giddings Medical Recruitment Committee, and is on the Knox Learning Center Advisory Committee.\r\n\r\nRudy has stated, " I believe in the community. You have to give something to get something. I sincerely appreciate all the support that this community has given, not only me but my family and my company, Mayer Realty & Associates. Your continued support is valued and appreciated, thereby enabling me to return to the community, some of the good things that it has given me."\r\n', '', '', '', '', '', '', '', '', '1054'),
(108, '0272193', 'BARBARA PASK', 'bpask3@aol.com', '817-980-8338', 18239, 'Barbara Pask.png', '', 'Barbara has thirty years of experience in the field and has been not only a sales agent and a sales manager, but, has also been the owner/broker of her own real estate company for 8 years.\r\n\r\n"Professionalism is paramount in my business! I was honored to be elected twice as President of the Greater Metro West Association of Realtors. Also, I was twice recognized as REALTORÂ® of the Year for this organization. I have been successful in all areas of real estate including residential, farm & ranch, and commercial sales. In this "new age" of real estate I can assist the first time buyer or the experienced seller navigate all of the challenges of this market. I welcome all of my past clients to visit me at CENTURY 21 Lynch & Associates and I hope to meet many new faces at my new location."', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(109, '0450552', 'CHERYL MINER', 'cherme101@yahoo.com', '817-596-5003', 18263, 'Cheryl Miner.png', '', 'Hello, my name is Cheryl Miner, I have been a Realtor since 1996 serving Parker, Palo Pinto, Hood, Tarrant and all surrounding counties.\r\n\r\nMy Real Estate family "CENTURY 21 Lynch & Associates" is the number one Real Estate company in Parker county.\r\n\r\nI am very diverse in meeting ALL your Real Estate needs from Homes to Commercial to Ranches, whether it be listing or purchasing, I strive for perfection for your satisfaction.\r\n\r\nReal Estate Membership:\r\nGreater Fort Worth Association of Realtors\r\nTexas Association of Realtors\r\nNorth Texas Real Estate Information Systems\r\nREALTOR, National Association of REALTORS\r\n\r\nPersonal:\r\nI have been married for 34 years, live on a farm in Lipan Texas where we raise cattle and I enjoy my new Paint Pony "Dancer" I have three children and five grandchildren,\r\nMy husband and I have owned a hardwood floorng company "Rodâ€™s Custom Floors" for 30 years.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(110, '0571638', 'CHRISTI SEARS PIROTTE', 'christisears22@gmail.com', '817-925-5319', 17804, 'Christi Sears.png', '', 'Christi  Sears Pirotte has many fond memories of growing up in Aledo. A resident since her family moved to the town when she was only one,\r\nChristiâ€™s grandparents, Rosemary and Frank Guse, moved here in 1967. Her grandfather was an interior decorator who refurbished Hillmont Ranch off Farm Road 5; and Christiâ€™s parents, Joann and John Sears, purchased land at what is now known as Quail Ridge Road. They quickly became active in the Aledo community and school district, and they were fortunate to watch generations of the townâ€™s children grow to be successful adults as the city itself has flourished.\r\nA 1988 Aledo High School graduate, Christi earned a bachelors degree in elementary education from Texas Christian University. A teacher at Brewer Middle School in White Settlement ISD for 12 1/2 years, Christi dedicated herself to working with kids. Her enthusiasm and passion for these young teens was exemplified as she served as the schoolâ€™s cheerleading coach, yearbook advisor, and sponsor of the Builders Club, a student organization which participated in a variety of community service projects. She was recognized by students as Whoâ€™s Who Among Americaâ€™s Teachers for four years, an honor that only a small percentage of teachers will receive only once in their career.\r\nShe touched the lives of students and developed life-long relationships with many of the kids she taught. Being a teacher and knowing the potential impact that she could have on a childâ€™s life made her recent decision to pursue a career in real estate very difficult. However, her fascination and interest in real estate began many years ago. She was childhood friends with the Lynchâ€™s daughter, Sammie, and she has many wonderful memories of the times she spent at the Lynch home and watching the family build its business into the #1 real estate company it is today.\r\nA member of the West Fort Worth Kiwanis Club, Texas Association of Realtors, National Association of Realtors, Metroplex Multiple Listing Service,\r\nWomenâ€™s Council of Realtors, and the Greater Fort Worth Association of Realtors. Christi is a member of Travis Avenue Baptist Church.\r\nChristi now owns land in Aledo, where she plans to build her dream home. She canâ€™t imagine living anywhere else and considers it an honor to have the opportunity to join the Lynch team as a realtor.\r\nChristiâ€™s bubbly personality lights up any room. Her enthusiasm and energy for every endeavor is contagious, and she is always willing to go the extra mile to ensure success. Christi is known for her honesty, integrity and trustworthiness. Itâ€™s no surprise that everyone she meets loves and respects her.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(111, '0530909', 'HARRY SCOGGIN', 'harry.scoggin@CENTURY21.com', '972-998-9615', 18181, 'Harry Scoggin.png', '', 'Greater Fort Worth Association of Realtors, Texas Association or Realtors, North Texas Real Estate Information Systems, REALTOR, National Association of REALTORS', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(115, '0594860', 'NICK DETHERAGE', 'nick.detherage@century21.com', '817-994-1789', 594860, '1339530644.jpg', '', 'I have lived in Parker County area all my life and have seen major growth.  \r\n\r\nLicensed in 2009, but have been in customer service for 20 years.\r\n\r\nWith my negotiation skills a seller can expect the maximum profits for their home and a buyer, the greatest value for their home purchase.\r\n\r\nI have made real estate my business. With a supportive team, and the desire to serve, Iâ€™m  the right choice for selling or buying a home.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(116, '0453517', 'PIPER PARDUE', 'papardue@aol.com', '817-269-8735', 15250, 'Piper Pardue.png', 'http://www.reesandpiperteam.com', 'Piper graduated with a degree in Marketing from Texas A & M University, School of Business 1996 and became active in the real estate market in 1998.\r\n\r\nIn 2000 Rees and Piper felt the need to provide a higher level of service to customers and concepted the "Rees and Piper" team in which two top producing Brokers could use their unique specialties to provide a higher level of service than any single agent could provide. Results of this partnership have been unsurpassed with team sales exceeding every other agent or team in Parker County with over 35 million dollars in real estate sold in 2006. The Rees and Piper Team are ranked in the top 3 in the state and in the top 25 in the nation in the Century 21 system.\r\n\r\n\r\n2001 CENTURIONÂ®\r\nMillion In A Month\r\nMasters Award 1999-2002\r\nTop 21 Agent Award in Gross Closed Commissions\r\n\r\nEducation:\r\nBrokers License\r\nBachelorâ€™s Degree in Business Marketing and Communications\r\nTexas A&M University 1992 - 1996\r\nFred Pryorâ€™s Time Management Courses\r\nProfessional Courses required by Texas Association of Realtors\r\n\r\nReal Estate:\r\nGreater Fort Worth Board of Realtors\r\nTexas Association of Realtors\r\nNorth Texas Real Estate Information Systems\r\nREALTOR, National Association of REALTORS\r\n\r\nAffiliations:\r\nAmerican Marketing Association\r\nTexas A&M University Alumni Association\r\nDelta Delta Delta Panhellenic Alumni\r\nFort Worth Barnaby Club\r\nFort Worth Jr Womens Club\r\n\r\nPersonal:\r\nHobbies include traveling, gardening and shopping.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(117, '7800597', 'ROBIN SANDUSKY', 'robin.sandusky@CENTURY21.com', '817-441-8059', 17489, 'ROBIN SANDUSKY.png', '', 'Robin is a native of Fort Worth, Texas and now resides in the Aledo, Texas area. Robin and her husband David are very involved in their church and childrens lives. Robin attended the Baptist Bible College of Missouri where she received her secretarial certificate.', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(118, '0495359', 'STEPHEN MOORE', 'moore4urhome@yahoo.com', '817-307-3427', 16829, 'STEPHEN MOORE.png', '', 'Affiliations: Greater Fort Worth Association of REALTORSÂ®, North Texas Real Estate Information Systems, Texas Association of REALTORSÂ®, REALTORÂ®, National Association of REALTORSÂ®', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(275, '499274', 'B. RAY ARMAND', 'brayarmand@aol.com', '817-800-8291', 99999, 'imgres.png', '', '', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(131, '123455', 'test1', 'test1@yahoo.com', '', 123455, 'imgres.png', '', '', '', '', '', '', '', '', '', '', '1024'),
(128, '250042', 'Garry C. Brown', 'garry@garrybrownrealestate.com', '', 250042, 'imgres.png', '', '', '', '', '', '979-773-2816', '', '', '', '', '3983'),
(199, '1', 'olaa', 'psikik@inbox.com', '', 0, 'imgres.png', '', '', '', '', '', '', '', '', '', '', '3983'),
(132, '1234577', 'test6', 'test6@yahoo.com', '', 1234577, 'imgres.png', '', '', '', '', '', '', '', '', '', '', ''),
(133, '1234588', 'test9', 'test9@yahoo.com', '', 1234588, 'imgres.png', '', '', '', '', '', '', '', '', '', '', '1024'),
(139, '12345', 'rrrrrrrrrrrrrrrrrrrr', 'sadddddddd@hjsdkfkjjfsd.com', '', 2147483647, 'imgres.png', '', '', '', '', '', '', '', '', '', '', ''),
(208, '4564566546', 'testt', 'sdfdf@yahoo.com', '', 2147483647, 'imgres.png', '', '', '', '', '', '', '', '', '', '', 'treo_27'),
(153, '1234566', 'werwerwer', 'werwerwer@yahoo.com', '', 3454444, 'imgres.png', '', '', '555-555-5555', '555-555-5555', '555-555-5555', '555-555-5555', '555-555-5555', '555-555-5555', '555-555-5555-5555', '555-555-5555', 'treo_654321'),
(1, '17524', 'Tim Walther', 'info@westfallrealestate.com', '', 0, 'imgres.png', '', '', '', '', '', '', '', '', '', '', '1209'),
(272, '999999', 'HUNTER STOCKON', 'pigboy596@aol.com', '817-507-8819', 99999, 'hunterstockton.jpg', '', '', '', '', '', '', '', '', '', '', 'LYNC00FW'),
(220, '17097', 'Tiffany Compton-Falk', 'tiffany@tiffanycompton.com', '979-251-4036', 17097, '1360839847.jpg', '', 'Whether you are in the market to buy or sell, I am here to assist you with all your real estate needs. My goal is to make your buying and selling experience both efficient and pleasant. I have over 10 years of experience specializing in both residential and farm and ranch properties . Real Estate is my passion and I strive to conduct my business with integrity and to make each transaction as hassle-free as possible, always with your best interest in mind. I am proud to serve Washington and surrounding counties. Please stop by my office anytime, located in downtown Brenham. I look forward to hearing from you!!!', '979-836-8532', '', '', '979-836-1224', '888-882-1321', '', '', '', 'treo_341'),
(206, '345634645', 'dsfgddfgff', 'sdfgdfgdfsg@test.com', '', 546456546, 'imgres.png', '', '', '', '', '', '', '', '', '', '', 'treo_27'),
(182, 'asd', 'asda', 'sadasd@asda.com', '', 123, 'imgres.png', '', '', '', '', '', '', '', '', '', '', 'treo_95'),
(200, '2', 'agent2', 'agent2@yahoo.com', '', 2, 'imgres.png', '', '', '', '', '', '', '', '', '', '', 'treo_229'),
(191, '3333333', 'Randy Heber', 'info@hvvvvvvvvvvvvvvvealthygrid.com', '614-360-1222', 1232344, 'imgres.png', '', '', '', '', '', '614-360-1222', '614-360-1222', '', '', '', 'treo_9'),
(169, '88855555', 'fgdfgfg', 'dfgdfgfg@gmail.com', '888-888-8888', 55566777, 'http://publicfusion.com/treo/wp-content/uploads/amerisale-re/1354013337.png', '', '', '888-888-8888', '888-888-8888', '888-888-8888', '888-888-8888', '888-888-8888', '888-888-8888', '888-888-8888-8888', '888-888-8888', 'treo_654321'),
(207, '4576567567', 'xzvxcfvcvb', 'cvbcvbcvb@test.com', '333-333-3333', 2147483647, 'imgres.png', '', '', '333-333-3333', '333-333-3333', '', '', '333-333-3333', '', '', '', 'treo_27'),
(179, '123123', 'joie ann', 'sadasd@asda.com', '', 123, 'imgres.png', '123', '', '', '', '', '', '', '', '', '', 'treo_95'),
(238, '0289187', 'SHARON PONDER', 'ponder2@att.net', '817-304-0145', 289187, 'Sharon.Ponder.jpg', '', 'Sharon was born and raised in Weatherford.  She has two daughters and one son.  \r\n \r\nShe earned an AA degree from Weatherford College, where she took real estate classes, and became an agent.  Sharon began with Century 21, and has also been associated with Kathy Evans RE and REMax.  After retirement from Lockheed Martin, she rejoined the real estate business with  Prudential TX Properties.  \r\n \r\nSharon receives great pleasure in helping buyers find homes and sellers be able to move on!', '', '', '', '817-441-7932', '', '', '', '', 'LYNC00FW'),
(212, '456757567', 'dfgdfgdfg', 'dfgdfgf@test.com', '', 567567567, '1362455905.jpg', '', '', '', '', '', '', '', '', '', '', 'treo_1'),
(213, '45675756', 'sdfsdfdf', 'sdfsdfsdf@test.com', '', 56756767, 'imgres.png', '', '', '', '', '', '', '', '', '', '', 'treo_1'),
(183, '123123', 'qwe', 'sadasd@asda.com', '', 123, 'imgres.png', '', '', '', '', '', '', '', '', '', '', 'treo_95'),
(180, '123123', 'joie ann w', 'sadasd@asda.com', '', 123, 'imgres.png', '123', '', '', '', '', '', '', '', '', '', 'treo_95'),
(221, '16763', 'Tammy Foreman', 'tammy@hodderealty.com', '979-451-2954', 16763, '1360839820.jpg', 'http://www.hodderealty.com', 'Whether you are in the market to buy or sell property, I am here for all your real estate needs. Specializing in farms, ranches, weekend properties and rural areas and representing Buyers and Sellers all over Texas for 10 years. I am a member of St. Peterâ€™s Episcopal Church and have served on the Vestry. I am the Board President of the CASA For Kids and serve on the Washington County Horse Committee. I have established a reputation for providing excellent service and support. Representing families concluding transactions that maximum value in a reasonable time. My career is based on honesty, integrity and professionalism. I am here to serve you!', '', '', '', '979-836-1224', '888-882-1321', '', '979-836-8532-', '', 'treo_341'),
(205, '1234532453', 'sdfgdfg', 'dfgdsfgsd@test.com', '', 1324235454, 'imgres.png', '', '', '', '', '', '', '', '', '', '', 'treo_27'),
(204, '1111', 'jj', 'joie_angel2002@yahoo.com', '111-111-11', 11, 'imgres.png', '11', '', '', '', '', '', '', '', '111-111-111-1111', '111-111-111', 'treo_101'),
(222, '15283', 'Debbie Hodde', 'debbie@hodderealty.com', '', 15283, '1360839724.jpg', 'http://www.hodderealty.com', '', '979-836-8532', '', '', '979-836-1224', '888-882-1321', '', '979-836-8532-', '', 'treo_341');
INSERT INTO `agents` (`id`, `agent_license_no`, `Name`, `email_address`, `phone_number`, `agent_id`, `photo`, `Agent_link`, `agent_desc`, `officephone`, `metro1`, `metro2`, `fax`, `tollfree`, `pager`, `voicemail`, `home_phone`, `agent_offcode`) VALUES
(223, '2300', 'Leroy Hodde', 'info@hodderealty.com', '', 2300, '1360840077.png', 'http://www.hodderealty.com', '', '979-836-8532', '', '', '979-836-1224', '', '', '979-836-8532-', '', 'treo_341'),
(224, '2297', 'Randy Hodde', 'rhodde@hodderealty.com', '', 2297, '1360838743.jpg', 'http://www.hodderealty.com', 'My roots begin here in Brenham, Texas (Home of Blue Bell Ice Cream). Growing up on our family ranch, I have experienced and learned many valuable things about living in the country. I assist buyers trying to find the â€œrightâ€ property and sellers market their property efficiently by using the latest technology. By having a degree in IT-Design & Development, I create custom aerial maps and renderings. This is very valuable tool for land planning and when searching for the right characteristics in a property such as: Shape/layout, road frontage, topography/terrain, and vegetation. Whether looking to buy or sell, I can assist you in many capacities!', '', '', '', '979-836-1224', '888-882-1321', '', '979-836-8532-', '', 'treo_341'),
(225, '15915', 'Ashley Jahnke', 'ashley@hodderealty.com', '', 15915, '1360839691.jpg', 'http://www.brenhamrealestate.com', '', '979-836-8532', '', '', '979-836-1224', '888-882-1321', '', '979-836-8532-', '', 'treo_341'),
(237, '9453211222', 'test5', 'test5@yahoo.com', NULL, 2147483647, '1360574571.jpg', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'treo_346'),
(226, '16294', 'Kaysee Schulte', 'kaysee@hodderealty.com', '', 16294, '1360839759.jpg', '', '', '979-836-8532', '', '', '979-836-1224', '888-882-1321', '', '979-836-8532-', '', 'treo_341'),
(231, '98987777', 'allene', 'allene@test.com', '', 98987777, '1360567316.jpg', '', '', '', '', '', '', '', '', '', '', 'treo_348'),
(242, 'fhfjhjj', 'ioupoup', 'opup@gj.hkk', '', 0, '1362013393.jpg', '', '', '', '', '', '', '', '', '', '', 'treo_1'),
(243, '235235', 'agent1', 'ageg@gg.gg', '', 2424, '1362133737.jpg', '', '', '', '', '', '', '', '', '', '', 'treo_1'),
(259, '234564433', 'test5', 'test5@test.com', '', 234564433, 'imgres1.png', '', '', '', '', '', '', '', '', '', '', 'treo_1'),
(258, '453223311', 'test agent3', 'testagent3@yahoo.com', '', 453223311, '1362133674.jpg', '', '', '', '', '', '', '', '', '', '', 'treo_1'),
(247, '12345678222', 'gdfgdfg', 'test@yahoo.com', '', 2147483647, '1362133614.jpg', '', '', '', '', '', '', '', '', '', '', 'treo_1'),
(248, '234546222', 'dfdssdfsd', 'ftest@test.com', '', 234546222, 'imgres1.png', '', '', '', '', '', '', '', '', '', '', 'treo_1'),
(252, '1234655555', 'sgfdgdfg', 'test@yahoo.com', '', 1234655555, '', '', '', '', '', '', '', '', '', '', '', 'treo_1'),
(260, '234567866', 'test', 'test@test.com', '', 234567866, 'imgres1.png', '', '', '', '', '', '', '', '', '', '', 'treo_424'),
(256, '0620360', 'SABRINA COATES', 'scoates@c21lynch.com', '817-269-3907', 620360, 'SABRINA COATES.2.jpg', 'www.lynchlegacygroup.com', '', '', '', '', '817-441-7932', '', '', '', '', 'LYNC00FW'),
(257, '45622224411', 'test agent', 'test@yahoo.com', '', 2147483647, 'imgres1.png', '', '', '', '', '', '', '', '', '', '', 'treo_421'),
(261, '12345678444', 'test444', 'tes2t@test.com', '', 2147483647, '1362212005.jpg', '', '', '', '', '', '', '', '', '', '', 'treo_427'),
(262, '3456789222', 'test5', 'test5@test.com', '', 2147483647, 'imgres1.png', '', '', '', '', '', '', '', '', '', '', 'treo_1'),
(263, '789541222144', 'test agent 2', 'test@yahoo.com', '111-111-1111', 2147483647, '1363313790.png', '', 'test description', '111-111-1111', '111-111-1111', '111-111-1111', '111-111-1111', '111-111-1111', '111-111-1111', '111-111-1111-1111', '111-111-1111', 'treo_1'),
(265, '54656588', 'test allene', 'testallene@test.com', '777-777-7777', 54656588, '1363322897.png', 'www.google.com', '', '111-111-1111', '222-222-2222', '333-333-3333', '444-444-4444', '555-555-5555', '666-666-6666', '888-888-8888-8888', '999-999-9999', 'treo_471'),
(266, '46545654', 'allene2', 'allene2@test.com', '', 46545654, '1363323411.png', '', 'test', '', '', '', '', '', '', '', '', 'treo_471'),
(267, '456546544', 'allene4', 'allene4@test.com', '777-777-7777', 456546544, '1363323645.png', 'www.google.com', 'test4', '111-111-1111', '222-222-2222', '333-333-3333', '444-444-4444', '555-555-5555', '666-666-6666', '888-888-888-8888', '999-999-9999', 'treo_471'),
(268, '345656555', 'testagent5', 'testagent5@test.com', '', 345656555, 'imgres1.png', '', '', '', '', '', '', '', '', '', '', 'treo_472'),
(269, '338383563', 'myagent', 'myagent@agent.com', '', 7353543, 'imgres1.png', '', '', '', '', '', '', '', '', '', '', 'treo_473'),
(270, '88888', 'Jonnas', 'jonas@agent.com', '', 88888888, 'imgres1.png', '', '', '', '', '', '', '', '', '', '', 'treo_473'),
(271, '53454354', 'testagent2', 'testagent2@test.com', '', 53454354, 'imgres1.png', '', '', '', '', '', '', '', '', '', '', 'treo_475'),
(418, '9''789', 'awd', 'awd@asd.com', '85-674-967', 6578, 'imgres.png', '967', 'awdadw', '455-65-765', '756-675-785', '675-678-8789', '07-096-586', '74-56-4', '795-068-756', '086-86-7856-85', '674-578-07', '1154'),
(419, 'iraq', 'ayman', 'ssalqasem@yahoo.com', '568-897-0897', 0, 'imgres.png', 'www.faceboo.com/security', 'qwer', '*96-564-5464', '789-651-+645', '595-456-567', '076-767-3434', '786-545-8970', '765-897-6587', '956-675-6578-6565', '567-696-9657', '1154'),
(420, '111111111111111111', 'xxxxx', 'x@yahoo.com', '', 2147483647, 'imgres.png', '', '', '111-111-1111', '111-1-', '', '', '', '', '', '', '3983'),
(422, 'ZG8089', 'z ganguly', 'gangulymyname@gmail.com', '', 569, 'http://texasproperty.com/wp-content/uploads/amerisale-re/1401445978.png', 'http://enchanter.co.in', '', '', '', '', '', '', '', '', '', ''),
(424, '', '', '', '', 0, 'imgres1.png', '', '', '', '', '', '', '', '', '', '', '3983');

-- --------------------------------------------------------

--
-- Table structure for table `agentsimage`
--

CREATE TABLE IF NOT EXISTS `agentsimage` (
  `Id` int(11) NOT NULL,
  `offcode` varchar(10) CHARACTER SET utf8 NOT NULL,
  `url` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `austinmaping`
--

CREATE TABLE IF NOT EXISTS `austinmaping` (
  `id` int(11) NOT NULL,
  `acres` varchar(255) DEFAULT NULL,
  `acre_price` varchar(255) DEFAULT NULL,
  `agentlist` text,
  `agent_name` varchar(255) DEFAULT NULL,
  `area` text,
  `assocfee` varchar(255) DEFAULT NULL,
  `assocfeeincludes` varchar(255) DEFAULT NULL,
  `assocfeepaid` varchar(255) DEFAULT NULL,
  `baths` int(11) DEFAULT NULL,
  `bedrooms` int(11) DEFAULT NULL,
  `block` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `directions` varchar(255) DEFAULT NULL,
  `floors` varchar(255) DEFAULT NULL,
  `garage_cap` int(11) DEFAULT NULL,
  `garage_desc` varchar(255) DEFAULT NULL,
  `HOA` varchar(255) DEFAULT NULL,
  `housing_type` varchar(255) DEFAULT NULL,
  `legal` varchar(255) DEFAULT NULL,
  `listprice` varchar(255) DEFAULT NULL,
  `listprice_low` varchar(255) DEFAULT NULL,
  `listprice_orig` varchar(255) DEFAULT NULL,
  `listprice_range` varchar(255) DEFAULT NULL,
  `liststatus` varchar(255) DEFAULT NULL,
  `MLS` bigint(20) DEFAULT NULL,
  `photocount` int(11) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `sqft_price` varchar(255) DEFAULT NULL,
  `sqft_source` varchar(255) DEFAULT NULL,
  `sqft_total` bigint(20) DEFAULT NULL,
  `sqft_total_price` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `street_name` varchar(255) DEFAULT NULL,
  `street_num` int(11) DEFAULT NULL,
  `street_type` varchar(255) DEFAULT NULL,
  `subarea` int(11) DEFAULT NULL,
  `sub_division` varchar(255) DEFAULT NULL,
  `taxid` bigint(20) DEFAULT NULL,
  `uid` bigint(20) DEFAULT NULL,
  `utility` varchar(500) DEFAULT NULL,
  `yearbuilt` int(11) DEFAULT NULL,
  `yearbuiltdesc` varchar(255) DEFAULT NULL,
  `num_dining_areas` int(11) DEFAULT NULL,
  `num_living_areas` int(11) DEFAULT NULL,
  `officelist` varchar(255) DEFAULT NULL,
  `offcname1` varchar(255) DEFAULT NULL,
  `offcname2` varchar(255) DEFAULT NULL,
  `propsubtype` varchar(255) DEFAULT NULL,
  `proptype` varchar(255) DEFAULT NULL,
  `schooldistrict` varchar(255) DEFAULT NULL,
  `schoolname1` varchar(255) DEFAULT NULL,
  `schoolname2` varchar(255) DEFAULT NULL,
  `schoolname3` varchar(255) DEFAULT NULL,
  `schoolname4` varchar(255) DEFAULT NULL,
  `msaterbed_width_hgt` varchar(255) DEFAULT NULL,
  `bed2_width_hgt` varchar(255) DEFAULT NULL,
  `bed3_width_hgt` varchar(255) DEFAULT NULL,
  `bed4_width_hgt` varchar(255) DEFAULT NULL,
  `bed5_width_hgt` varchar(255) DEFAULT NULL,
  `brkfast_width_hgt` varchar(255) DEFAULT NULL,
  `dining_width_hgt` varchar(255) DEFAULT NULL,
  `kitchen_width_hgt` varchar(255) DEFAULT NULL,
  `living1_width_hgt` varchar(255) DEFAULT NULL,
  `living2_width_hgt` varchar(255) DEFAULT NULL,
  `living3_width_hgt` varchar(255) DEFAULT NULL,
  `garage_width_hgt` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `bath_half` float DEFAULT NULL,
  `bath_full` float DEFAULT NULL,
  `lotsize` varchar(255) DEFAULT NULL,
  `stories` varchar(255) DEFAULT NULL,
  `carport_space` int(11) DEFAULT NULL,
  `fire_place` int(11) DEFAULT NULL,
  `fire_desc` varchar(255) DEFAULT NULL,
  `pool` int(11) DEFAULT NULL,
  `pool_desc` varchar(255) DEFAULT NULL,
  `restriction` varchar(255) DEFAULT NULL,
  `expired_date` varchar(100) DEFAULT NULL,
  `sysid` varchar(100) DEFAULT NULL,
  `prop_class` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `Id` int(11) NOT NULL,
  `city_name` varchar(200) CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=1352 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `city_old`
--

CREATE TABLE IF NOT EXISTS `city_old` (
  `id` int(11) NOT NULL,
  `city_name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=965 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `county`
--

CREATE TABLE IF NOT EXISTS `county` (
  `id` int(11) NOT NULL,
  `county_name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=257 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `financial`
--

CREATE TABLE IF NOT EXISTS `financial` (
  `id` int(11) NOT NULL,
  `mlsid` int(11) NOT NULL,
  `conventinal` tinyint(4) NOT NULL DEFAULT '0',
  `va_loan` tinyint(4) NOT NULL DEFAULT '0',
  `fha_loan` tinyint(4) NOT NULL DEFAULT '0',
  `owner_financed` tinyint(4) NOT NULL DEFAULT '0',
  `texas_vet` tinyint(4) NOT NULL DEFAULT '0',
  `highlight_1` text,
  `highlight_2` text,
  `highlight_3` text,
  `highlight_4` text,
  `ntreislist_id` bigint(20) NOT NULL,
  `n_id` bigint(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1810 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ip_blocks`
--

CREATE TABLE IF NOT EXISTS `ip_blocks` (
  `startIpNum` bigint(20) NOT NULL,
  `endIpNum` bigint(20) NOT NULL,
  `locId` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ip_location`
--

CREATE TABLE IF NOT EXISTS `ip_location` (
  `locId` bigint(20) NOT NULL,
  `country` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `region` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `city` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `postalCode` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `metroCode` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `areaCode` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lastmodified`
--

CREATE TABLE IF NOT EXISTS `lastmodified` (
  `id` int(11) NOT NULL,
  `type` varchar(11) NOT NULL,
  `modified_date` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ntreisimages`
--

CREATE TABLE IF NOT EXISTS `ntreisimages` (
  `id` int(11) NOT NULL,
  `n_id` bigint(20) NOT NULL,
  `mlsnum` bigint(20) DEFAULT NULL,
  `imagename` varchar(255) DEFAULT NULL,
  `caption_text` varchar(255) DEFAULT NULL,
  `recordListingID` int(11) NOT NULL DEFAULT '0',
  `ntreislist_id` bigint(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8264943 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ntreisimages`
--

INSERT INTO `ntreisimages` (`id`, `n_id`, `mlsnum`, `imagename`, `caption_text`, `recordListingID`, `ntreislist_id`) VALUES
(4912777, 256473, 6506761, 'http://publicfusion.com/images/abor/16/image-13717652-6.jpg', NULL, 0, 0),
(4912776, 256473, 6506761, 'http://publicfusion.com/images/abor/16/image-13717652-5.jpg', NULL, 0, 0),
(4912775, 256473, 6506761, 'http://publicfusion.com/images/abor/16/image-13717652-4.jpg', NULL, 0, 0),
(4912774, 256473, 6506761, 'http://publicfusion.com/images/abor/16/image-13717652-3.jpg', NULL, 0, 0),
(4912773, 256473, 6506761, 'http://publicfusion.com/images/abor/16/image-13717652-2.jpg', NULL, 0, 0),
(4912772, 256473, 6506761, 'http://publicfusion.com/images/abor/16/image-13717652-1.jpg', NULL, 0, 0),
(4912771, 256473, 6506761, 'http://publicfusion.com/images/abor/16/image-13717652-0.jpg', NULL, 0, 0),
(4708293, 207431, 6185432, 'http://publicfusion.com/images/abor/16/image-13369763-1.jpg', NULL, 0, 0),
(4708292, 207431, 6185432, 'http://publicfusion.com/images/abor/16/image-13369763-0.jpg', NULL, 0, 0),
(4396662, 207659, 1651385, 'http://publicfusion.com/images/abor/16/image-13369251-5.jpg', NULL, 0, 0),
(4396661, 207659, 1651385, 'http://publicfusion.com/images/abor/16/image-13369251-4.jpg', NULL, 0, 0),
(4396660, 207659, 1651385, 'http://publicfusion.com/images/abor/16/image-13369251-3.jpg', NULL, 0, 0),
(4396659, 207659, 1651385, 'http://publicfusion.com/images/abor/16/image-13369251-2.jpg', NULL, 0, 0),
(4396658, 207659, 1651385, 'http://publicfusion.com/images/abor/16/image-13369251-1.jpg', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ntreislist`
--

CREATE TABLE IF NOT EXISTS `ntreislist` (
  `id` int(11) NOT NULL,
  `rets_area` varchar(14) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `acres` varchar(255) DEFAULT NULL,
  `acre_price` varchar(255) DEFAULT NULL,
  `agentlist` text,
  `agent_name` varchar(255) DEFAULT NULL,
  `area` text,
  `assocfee` varchar(255) DEFAULT NULL,
  `assocfeeincludes` varchar(255) DEFAULT NULL,
  `assocfeepaid` varchar(255) DEFAULT NULL,
  `baths` int(11) DEFAULT NULL,
  `bedrooms` int(11) DEFAULT NULL,
  `locale` varchar(100) DEFAULT NULL,
  `open_house` varchar(100) DEFAULT NULL,
  `date1` date DEFAULT NULL,
  `date1start_time` varchar(100) DEFAULT NULL,
  `date1end_time` varchar(100) NOT NULL,
  `date2` date NOT NULL,
  `date2start_time` varchar(100) NOT NULL,
  `date2end_time` varchar(100) DEFAULT NULL,
  `sales_pending` varchar(100) DEFAULT NULL,
  `premium` varchar(100) DEFAULT NULL,
  `sold` varchar(100) DEFAULT NULL,
  `block` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `directions` varchar(255) DEFAULT NULL,
  `floors` varchar(255) DEFAULT NULL,
  `garage_cap` int(11) DEFAULT NULL,
  `garage_desc` varchar(255) DEFAULT NULL,
  `HOA` varchar(255) DEFAULT NULL,
  `housing_type` varchar(255) DEFAULT NULL,
  `legal` varchar(255) DEFAULT NULL,
  `listprice` varchar(255) DEFAULT NULL,
  `listprice_low` varchar(255) DEFAULT NULL,
  `listprice_orig` varchar(255) DEFAULT NULL,
  `listprice_range` varchar(255) DEFAULT NULL,
  `liststatus` varchar(255) DEFAULT NULL,
  `MLS` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `photocount` int(11) DEFAULT NULL,
  `remarks` text,
  `sqft_price` varchar(255) DEFAULT NULL,
  `sqft_source` varchar(255) DEFAULT NULL,
  `sqft_total` bigint(20) DEFAULT NULL,
  `sqft_total_price` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `street_name` varchar(255) DEFAULT NULL,
  `street_num` varchar(255) DEFAULT NULL,
  `street_type` varchar(255) DEFAULT NULL,
  `subarea` int(11) DEFAULT NULL,
  `sub_division` varchar(255) DEFAULT NULL,
  `taxid` bigint(20) DEFAULT NULL,
  `uid` bigint(20) DEFAULT NULL,
  `utility` varchar(500) DEFAULT NULL,
  `yearbuilt` varchar(20) DEFAULT NULL,
  `yearbuiltdesc` varchar(255) DEFAULT NULL,
  `num_dining_areas` int(11) DEFAULT NULL,
  `num_living_areas` int(11) DEFAULT NULL,
  `officelist` varchar(255) DEFAULT NULL,
  `offcname1` varchar(255) DEFAULT NULL,
  `offcname2` varchar(255) DEFAULT NULL,
  `propsubtype` varchar(255) DEFAULT NULL,
  `proptype` varchar(255) DEFAULT NULL,
  `schooldistrict` varchar(255) DEFAULT NULL,
  `schoolname1` varchar(255) DEFAULT NULL,
  `schoolname2` varchar(255) DEFAULT NULL,
  `schoolname3` varchar(255) DEFAULT NULL,
  `schoolname4` varchar(255) DEFAULT NULL,
  `msaterbed_width_hgt` varchar(255) DEFAULT NULL,
  `bed2_width_hgt` varchar(255) DEFAULT NULL,
  `bed3_width_hgt` varchar(255) DEFAULT NULL,
  `bed4_width_hgt` varchar(255) DEFAULT NULL,
  `bed5_width_hgt` varchar(255) DEFAULT NULL,
  `brkfast_width_hgt` varchar(255) DEFAULT NULL,
  `dining_width_hgt` varchar(255) DEFAULT NULL,
  `kitchen_width_hgt` varchar(255) DEFAULT NULL,
  `living1_width_hgt` varchar(255) DEFAULT NULL,
  `living2_width_hgt` varchar(255) DEFAULT NULL,
  `living3_width_hgt` varchar(255) DEFAULT NULL,
  `garage_width_hgt` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `bath_half` float DEFAULT NULL,
  `bath_full` float DEFAULT NULL,
  `lotsize` varchar(255) DEFAULT NULL,
  `stories` varchar(255) DEFAULT NULL,
  `carport_space` int(11) DEFAULT NULL,
  `fire_place` int(11) DEFAULT NULL,
  `fire_desc` varchar(255) DEFAULT NULL,
  `pool` enum('Y','N') DEFAULT 'N',
  `pool_desc` varchar(255) DEFAULT NULL,
  `handicapt` enum('Y','N') DEFAULT 'N',
  `restriction` varchar(255) DEFAULT NULL,
  `virtual_tour` varchar(255) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `sysid` varchar(100) DEFAULT NULL,
  `featured_listings` tinyint(4) NOT NULL DEFAULT '0',
  `is_img_import` tinyint(4) NOT NULL DEFAULT '0',
  `is_manual_edit` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `is_update_rets` tinyint(4) NOT NULL DEFAULT '0',
  `year_built` date NOT NULL,
  `offices` varchar(100) DEFAULT NULL,
  `restrooms` varchar(100) DEFAULT NULL,
  `meeting_spaces` varchar(100) DEFAULT NULL,
  `parking_spaces` varchar(100) DEFAULT NULL,
  `barns` varchar(100) DEFAULT NULL,
  `sheds` varchar(100) DEFAULT NULL,
  `shops` varchar(100) DEFAULT NULL,
  `ponds` varchar(100) DEFAULT NULL,
  `stock_tanks` varchar(100) DEFAULT NULL,
  `corrals` varchar(100) DEFAULT NULL,
  `pens` varchar(100) DEFAULT NULL,
  `units` varchar(100) DEFAULT NULL,
  `delete_status` enum('0','1') NOT NULL DEFAULT '0',
  `dont_overwrite` enum('0','1') NOT NULL DEFAULT '0',
  `email_expire` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=478829 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ntreislist`
--

INSERT INTO `ntreislist` (`id`, `rets_area`, `acres`, `acre_price`, `agentlist`, `agent_name`, `area`, `assocfee`, `assocfeeincludes`, `assocfeepaid`, `baths`, `bedrooms`, `locale`, `open_house`, `date1`, `date1start_time`, `date1end_time`, `date2`, `date2start_time`, `date2end_time`, `sales_pending`, `premium`, `sold`, `block`, `city`, `county`, `directions`, `floors`, `garage_cap`, `garage_desc`, `HOA`, `housing_type`, `legal`, `listprice`, `listprice_low`, `listprice_orig`, `listprice_range`, `liststatus`, `MLS`, `modified`, `photocount`, `remarks`, `sqft_price`, `sqft_source`, `sqft_total`, `sqft_total_price`, `state`, `street_name`, `street_num`, `street_type`, `subarea`, `sub_division`, `taxid`, `uid`, `utility`, `yearbuilt`, `yearbuiltdesc`, `num_dining_areas`, `num_living_areas`, `officelist`, `offcname1`, `offcname2`, `propsubtype`, `proptype`, `schooldistrict`, `schoolname1`, `schoolname2`, `schoolname3`, `schoolname4`, `msaterbed_width_hgt`, `bed2_width_hgt`, `bed3_width_hgt`, `bed4_width_hgt`, `bed5_width_hgt`, `brkfast_width_hgt`, `dining_width_hgt`, `kitchen_width_hgt`, `living1_width_hgt`, `living2_width_hgt`, `living3_width_hgt`, `garage_width_hgt`, `zipcode`, `bath_half`, `bath_full`, `lotsize`, `stories`, `carport_space`, `fire_place`, `fire_desc`, `pool`, `pool_desc`, `handicapt`, `restriction`, `virtual_tour`, `expired_date`, `sysid`, `featured_listings`, `is_img_import`, `is_manual_edit`, `is_update_rets`, `year_built`, `offices`, `restrooms`, `meeting_spaces`, `parking_spaces`, `barns`, `sheds`, `shops`, `ponds`, `stock_tanks`, `corrals`, `pens`, `units`, `delete_status`, `dont_overwrite`, `email_expire`) VALUES
(410773, 'abor', '0.760', '32894.7368421', '217957', '', 'LC', '', '', '', 0, 0, NULL, NULL, NULL, NULL, '', '0000-00-00', '', NULL, NULL, NULL, NULL, 0, 'Lexington', 'Lee', 'From Lexington, TX go North approximately 1 mile on Hwy 77. Turn left on Harry Street. Go approximately 1 mile. Make a left on Phillips Street. Property is on your right. There is a sign on the property.', '', 0, '', '', '', 'BRADEMAN, LOT 37B, ACRES 0.76', '25000.00', '', '25000.00', '', 'Active', '4452374', '2014-06-05 10:51:51', 2, 'Both lots 37B and 37C have a lot of beautiful trees and shrubs. Very quiet location. Water and electricity are available. Both lots are $25,000 or one lot for $15,000.', '', '', 0, NULL, 'TX', 'Phillips', '37B & 37C', '', 0, 'Brademan', 0, 0, 'See Agent', '', '', 0, 0, '6676', 'Sherrill Real Estate Interest', '', 'See Agent', 'Lot', 'Lexington ISD', 'Lexington', 'N/A', '', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78947', 0, 0, '', '', 0, 0, '', 'N', '', 'N', '', NULL, '0000-00-00', '15316445', 0, 0, '2', 0, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 0),
(410255, 'abor', '0.880', '45454.5454545', '217957', '', 'LC', '', '', '', 0, 0, NULL, NULL, NULL, NULL, '', '0000-00-00', '', NULL, NULL, NULL, NULL, 0, 'Lexington', 'Lee', 'Take Hwy 77 to Hester Street. Hester Street ends at Ave G.', '', 0, '', '', '', 'MOBILE HOME, LABEL# PFS0430609, SN1 12527411, TITLE # 00880134', '40000.00', '', '40000.00', '', 'Active', '4509690', '2014-04-22 11:49:06', 1, '', '', '', 0, NULL, 'TX', 'Avenue G', '406', '', 0, '1-L102', 0, 0, 'See Agent', '', '', 0, 0, '6676', 'Sherrill Real Estate Interest', '', 'See Agent', 'Lot', 'Lexington ISD', 'Lexington', 'N/A', '', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78947', 0, 0, '.02170', '', 0, 0, '', 'N', '', 'N', '', NULL, '0000-00-00', '14922891', 0, 0, '2', 0, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 0),
(409290, 'abor', '131.500', '3954.37262357', '217957', '', 'LC', '0', '', '', 2, 3, NULL, NULL, NULL, NULL, '', '0000-00-00', '', NULL, NULL, NULL, NULL, 0, 'Dime Box', 'Lee', 'Take Hwy 21S to FM 402. Turn right on FM 402. Go 2 miles and property is on the left.', 'See Agent', 0, '', 'na', '', 'A006 BYNUM, W. H., TRACT 025 & 025A, ACRES 80.241', '520000.00', '', '520000.00', '', 'Pending', '9154965', '2014-04-16 11:04:26', 6, '', '684.21', '', 760, NULL, 'TX', 'Private Road 4021', '1231', '', 0, 'BYNUM', 0, 0, 'See Agent', '1996', 'Unknown', 1, 1, '6676', 'Sherrill Real Estate Interest', '', 'Mobile Home', 'Farms/Ranch/Acreage', 'Dime Box ISD', 'Dime Box', 'N/A', '', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '77853', 0, 2, '', '', 0, 0, '', 'N', '', 'N', '', NULL, '0000-00-00', '14844066', 0, 0, '2', 0, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 0),
(256473, 'abor', '133.331', '3900.0682511944', '217957', '', 'LC', '', '', '', 2, 3, NULL, NULL, NULL, NULL, '', '0000-00-00', '', NULL, NULL, NULL, NULL, 0, 'Dime Box', 'Lee', 'Turn North on FM 402 off of Hwy 21, Take left on PR 4021.', 'See Agent', 0, '', '', '', '133.331 acres', '520000.00', '', '520000.00', '', 'Active', '6506761', '2013-08-12 10:46:00', 6, '', '309.52', '', 1680, NULL, 'TX', 'PR 4021', '4021', '', 0, 'Peterson', 0, 0, 'See Agent', '1998', 'Unknown', 1, 1, '6676', 'Sherrill Real Estate Interest', '', 'Mobile Home', 'Farms/Ranch/Acreage', 'Dime Box ISD', 'Dime Box', 'N/A', '', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '77853', 0, 2, '', '', 0, 0, '', 'N', '', 'N', '', NULL, '0000-00-00', '13717652', 0, 1, '2', 0, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 0),
(207431, 'abor', '0.660', '37878.787878788', '217957', '', 'LC', '', '', '', 0, 0, NULL, NULL, NULL, NULL, '', '0000-00-00', '', NULL, NULL, NULL, NULL, 0, 'Giddings', 'Lee', 'South on Hwy 77. Right on 100 W Bellville. Left on 600 South Williamson. Left at 300 W Cuero. Turn left at the end of the road (no street sign available)', '', 0, '', '', '', 'OT GIDDINGS, BLOCK 273, LOT 6 THRU 10', '25000.00', '', '25000.00', '', 'Active', '6185432', '2013-07-10 10:37:44', 1, '', '', '', 0, NULL, 'TX', 'Cuero', '301', 'ST', 0, 'Ot Giddings', 0, 0, 'See Agent', '', '', 0, 0, '6676', 'Sherrill Real Estate Interest', '', 'Multiple Lots (Adjacent)', 'Lot', 'Giddings ISD', 'Giddings', 'N/A', '', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78942', 0, 0, '', '', 0, 0, '', 'N', '', 'N', '', NULL, '0000-00-00', '13369763', 1, 1, '2', 0, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 0),
(207655, 'abor', '', '', '217957', '', 'LC', '', '', '', 1, 3, NULL, NULL, NULL, NULL, '', '0000-00-00', '', NULL, NULL, NULL, NULL, 0, 'Lexington', 'Lee', 'Lexington', 'See Agent', 0, 'Attached', '', '', 'NA', '40000.00', '', '40000.00', '', 'Active', '2719214', '2013-07-02 10:26:01', 5, '', '26.16', '', 1529, NULL, 'TX', 'DOUGLASS ST', '320', '', 0, 'Old Town Lexington', 0, 0, 'See Agent', '1962', 'Unknown', 1, 1, '6676', 'Sherrill Real Estate Interest', '', 'House', 'Residential', 'Lexington ISD', 'Lexington', 'N/A', '', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78947', 0, 1, '.217', '', 0, 0, '', 'N', '', 'N', '', NULL, '0000-00-00', '13369087', 1, 1, '2', 0, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 0),
(207659, 'abor', '0.500', '140000', '217957', '', 'LC', '', '', '', 2, 3, NULL, NULL, NULL, NULL, '', '0000-00-00', '', NULL, NULL, NULL, NULL, 0, 'Giddings', 'Lee', 'Off HWY 77, going South turn right onto FM 2440, right on 800 N Ellis, Left on 600 W Boundry and right on Navarro', 'See Agent', 0, '', '', '', 'MOBILE HOME, LABEL# PFS1059824, SN1 TXFL912A01969TL11, TITLE # 00314018', '70000.00', '', '70000.00', '', 'Active', '1651385', '2013-07-02 10:37:28', 5, '', '41.67', '', 1680, NULL, 'TX', 'Navarro', '1208', 'ST', 0, 'simple', 0, 0, 'See Agent', '2009', 'New', 1, 1, '6676', 'Sherrill Real Estate Interest', '', 'Mobile Home', 'Residential', 'Giddings ISD', 'Giddings', 'N/A', '', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78942', 0, 2, '.5', '', 0, 0, '', 'N', '', 'N', '', NULL, '0000-00-00', '13369251', 1, 1, '2', 0, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 0),
(422986, 'abor', '0.132', '431060.606061', '217957', '', 'LC', '', '', '', 1, 2, NULL, NULL, NULL, NULL, '', '0000-00-00', '', NULL, NULL, NULL, NULL, 0, 'Giddings', 'Lee', 'From Hwy 290, turn on FM 141, Go North past Giddings Public Library to North Brenham Street. Turn right. Second house on right is house', 'See Agent', 0, 'See Agent', '', '', 'OT GIDDINGS, BLOCK 71, LOT 8', '56900.00', '', '62500.00', '', 'Active', '5977254', '2014-08-19 10:33:56', 6, '', '69.90', '', 814, NULL, 'TX', 'Brenham', '852', 'ST', 0, 'Ot Giddings', 0, 0, 'See Agent', '1965', 'Approximate', 1, 1, '6676', 'Sherrill Real Estate Interest', '', 'See Agent', 'Residential', 'Giddings ISD', 'Giddings', 'N/A', '', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78942', 0, 1, '', '', 0, 0, '', 'N', '', 'N', '', NULL, '0000-00-00', '15534118', 0, 0, '2', 0, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE IF NOT EXISTS `office` (
  `ID` bigint(20) NOT NULL,
  `officelist` varchar(50) NOT NULL,
  `logo_url` varchar(250) NOT NULL,
  `company_address` varchar(100) NOT NULL,
  `company_number` varchar(50) NOT NULL,
  `officename` varchar(50) NOT NULL,
  `broker_image` varchar(250) NOT NULL,
  `broker_address` varchar(100) NOT NULL,
  `broker_number` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE IF NOT EXISTS `promo_codes` (
  `Id` int(20) NOT NULL,
  `code` varchar(20) NOT NULL,
  `duration` int(5) NOT NULL,
  `status` tinyint(5) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sabormaping`
--

CREATE TABLE IF NOT EXISTS `sabormaping` (
  `id` int(11) NOT NULL,
  `acres` varchar(255) DEFAULT NULL,
  `acre_price` varchar(255) DEFAULT NULL,
  `agentlist` text,
  `agent_name` varchar(255) DEFAULT NULL,
  `area` text,
  `assocfee` varchar(255) DEFAULT NULL,
  `assocfeeincludes` varchar(255) DEFAULT NULL,
  `assocfeepaid` varchar(255) DEFAULT NULL,
  `baths` varchar(100) DEFAULT NULL,
  `bedrooms` varchar(100) DEFAULT NULL,
  `block` varchar(100) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `directions` varchar(255) DEFAULT NULL,
  `floors` varchar(255) DEFAULT NULL,
  `garage_cap` varchar(100) DEFAULT NULL,
  `garage_desc` varchar(255) DEFAULT NULL,
  `HOA` varchar(255) DEFAULT NULL,
  `housing_type` varchar(255) DEFAULT NULL,
  `legal` varchar(255) DEFAULT NULL,
  `listprice` varchar(255) DEFAULT NULL,
  `listprice_low` varchar(255) DEFAULT NULL,
  `listprice_orig` varchar(255) DEFAULT NULL,
  `listprice_range` varchar(255) DEFAULT NULL,
  `liststatus` varchar(255) DEFAULT NULL,
  `MLS` varchar(100) DEFAULT NULL,
  `photocount` varchar(100) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `sqft_price` varchar(255) DEFAULT NULL,
  `sqft_source` varchar(255) DEFAULT NULL,
  `sqft_total` varchar(100) DEFAULT NULL,
  `sqft_total_price` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `street_name` varchar(255) DEFAULT NULL,
  `street_num` varchar(100) DEFAULT NULL,
  `street_type` varchar(255) DEFAULT NULL,
  `subarea` varchar(100) DEFAULT NULL,
  `sub_division` varchar(255) DEFAULT NULL,
  `taxid` varchar(100) DEFAULT NULL,
  `uid` varchar(100) DEFAULT NULL,
  `utility` varchar(500) DEFAULT NULL,
  `yearbuilt` varchar(100) DEFAULT NULL,
  `yearbuiltdesc` varchar(255) DEFAULT NULL,
  `num_dining_areas` varchar(100) DEFAULT NULL,
  `num_living_areas` varchar(100) DEFAULT NULL,
  `officelist` varchar(255) DEFAULT NULL,
  `offcname1` varchar(255) DEFAULT NULL,
  `offcname2` varchar(255) DEFAULT NULL,
  `propsubtype` varchar(255) DEFAULT NULL,
  `proptype` varchar(255) DEFAULT NULL,
  `schooldistrict` varchar(255) DEFAULT NULL,
  `schoolname1` varchar(255) DEFAULT NULL,
  `schoolname2` varchar(255) DEFAULT NULL,
  `schoolname3` varchar(255) DEFAULT NULL,
  `schoolname4` varchar(255) DEFAULT NULL,
  `msaterbed_width_hgt` varchar(255) DEFAULT NULL,
  `bed2_width_hgt` varchar(255) DEFAULT NULL,
  `bed3_width_hgt` varchar(255) DEFAULT NULL,
  `bed4_width_hgt` varchar(255) DEFAULT NULL,
  `bed5_width_hgt` varchar(255) DEFAULT NULL,
  `brkfast_width_hgt` varchar(255) DEFAULT NULL,
  `dining_width_hgt` varchar(255) DEFAULT NULL,
  `kitchen_width_hgt` varchar(255) DEFAULT NULL,
  `living1_width_hgt` varchar(255) DEFAULT NULL,
  `living2_width_hgt` varchar(255) DEFAULT NULL,
  `living3_width_hgt` varchar(255) DEFAULT NULL,
  `garage_width_hgt` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `bath_half` varchar(100) DEFAULT NULL,
  `bath_full` varchar(100) DEFAULT NULL,
  `lotsize` varchar(255) DEFAULT NULL,
  `stories` varchar(255) DEFAULT NULL,
  `carport_space` varchar(100) DEFAULT NULL,
  `fire_place` varchar(100) DEFAULT NULL,
  `fire_desc` varchar(255) DEFAULT NULL,
  `pool` varchar(100) DEFAULT NULL,
  `pool_desc` varchar(255) DEFAULT NULL,
  `restriction` varchar(255) DEFAULT NULL,
  `expired_date` varchar(100) DEFAULT NULL,
  `sysid` varchar(100) DEFAULT NULL,
  `prop_class` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `saved_searches`
--

CREATE TABLE IF NOT EXISTS `saved_searches` (
  `ID` bigint(20) NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `proptype` varchar(255) DEFAULT NULL,
  `bedrooms` varchar(255) DEFAULT NULL,
  `min` int(20) DEFAULT NULL,
  `max` int(20) DEFAULT NULL,
  `mls` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `treo_accounts`
--

CREATE TABLE IF NOT EXISTS `treo_accounts` (
  `ID` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `act_type` varchar(25) NOT NULL,
  `bill_type` varchar(10) NOT NULL,
  `balance` double NOT NULL,
  `due_date` date NOT NULL,
  `officelist` varchar(15) NOT NULL,
  `featured_limit` varchar(5) NOT NULL,
  `payment_process` varchar(50) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `mls_member` varchar(50) NOT NULL,
  `mls_type` varchar(50) NOT NULL,
  `mls_name` varchar(50) NOT NULL,
  `treo_partner` varchar(50) NOT NULL,
  `frm_paypal` varchar(50) NOT NULL,
  `finish_setup` varchar(50) NOT NULL DEFAULT '0',
  `email_expire` tinyint(4) NOT NULL DEFAULT '0',
  `agent_limit` int(5) NOT NULL DEFAULT '10',
  `promo` tinyint(4) NOT NULL DEFAULT '0',
  `promo_expire_email` tinyint(4) NOT NULL DEFAULT '0',
  `company_address` varchar(100) NOT NULL,
  `company_number` int(10) NOT NULL,
  `broker_address` varchar(100) NOT NULL,
  `broker_number` int(10) NOT NULL,
  `listing_limit` bigint(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=353 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `treo_account_items`
--

CREATE TABLE IF NOT EXISTS `treo_account_items` (
  `ID` bigint(20) NOT NULL,
  `account_id` bigint(20) NOT NULL,
  `mls` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL,
  `item_desc` varchar(25) NOT NULL,
  `item_charge` double NOT NULL,
  `transid` varchar(100) NOT NULL,
  `subscr_id` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `paid` tinyint(4) NOT NULL,
  `uid_sec` varchar(25) NOT NULL,
  `user_ip` varchar(25) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=785 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `treo_adrotate`
--

CREATE TABLE IF NOT EXISTS `treo_adrotate` (
  `id` mediumint(8) unsigned NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `bannercode` longtext NOT NULL,
  `thetime` int(15) NOT NULL DEFAULT '0',
  `updated` int(15) NOT NULL,
  `author` varchar(60) NOT NULL DEFAULT '',
  `imagetype` varchar(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` longtext NOT NULL,
  `tracker` varchar(5) NOT NULL DEFAULT 'N',
  `timeframe` varchar(6) NOT NULL DEFAULT '',
  `timeframelength` int(15) NOT NULL DEFAULT '0',
  `timeframeclicks` int(15) NOT NULL DEFAULT '0',
  `timeframeimpressions` int(15) NOT NULL DEFAULT '0',
  `type` varchar(10) NOT NULL DEFAULT '0',
  `weight` int(3) NOT NULL DEFAULT '6',
  `sortorder` int(5) NOT NULL DEFAULT '0',
  `cbudget` double NOT NULL DEFAULT '0',
  `ibudget` double NOT NULL DEFAULT '0',
  `crate` double NOT NULL DEFAULT '0',
  `irate` double NOT NULL DEFAULT '0',
  `cities` text NOT NULL,
  `countries` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_adrotate_blocks`
--

CREATE TABLE IF NOT EXISTS `treo_adrotate_blocks` (
  `id` mediumint(8) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `rows` int(3) NOT NULL DEFAULT '2',
  `columns` int(3) NOT NULL DEFAULT '2',
  `gridfloat` varchar(7) NOT NULL DEFAULT 'none',
  `gridpadding` int(2) NOT NULL DEFAULT '0',
  `adwidth` varchar(6) NOT NULL DEFAULT '125',
  `adheight` varchar(6) NOT NULL DEFAULT '125',
  `admargin` int(2) NOT NULL DEFAULT '1',
  `adborder` varchar(20) NOT NULL DEFAULT '0',
  `wrapper_before` longtext NOT NULL,
  `wrapper_after` longtext NOT NULL,
  `sortorder` int(5) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_adrotate_groups`
--

CREATE TABLE IF NOT EXISTS `treo_adrotate_groups` (
  `id` mediumint(8) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `modus` tinyint(1) NOT NULL DEFAULT '0',
  `fallback` varchar(5) NOT NULL DEFAULT '0',
  `sortorder` int(5) NOT NULL DEFAULT '0',
  `cat` longtext NOT NULL,
  `cat_loc` tinyint(1) NOT NULL DEFAULT '0',
  `page` longtext NOT NULL,
  `page_loc` tinyint(1) NOT NULL DEFAULT '0',
  `geo` tinyint(1) NOT NULL DEFAULT '0',
  `wrapper_before` longtext NOT NULL,
  `wrapper_after` longtext NOT NULL,
  `gridrows` int(3) NOT NULL DEFAULT '2',
  `gridcolumns` int(3) NOT NULL DEFAULT '2',
  `admargin` int(2) NOT NULL DEFAULT '1',
  `admargin_bottom` int(2) NOT NULL DEFAULT '1',
  `admargin_left` int(2) NOT NULL DEFAULT '1',
  `admargin_right` int(2) NOT NULL DEFAULT '1',
  `adwidth` varchar(6) NOT NULL DEFAULT '125',
  `adheight` varchar(6) NOT NULL DEFAULT '125',
  `adspeed` int(5) NOT NULL DEFAULT '6000'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_adrotate_linkmeta`
--

CREATE TABLE IF NOT EXISTS `treo_adrotate_linkmeta` (
  `id` mediumint(8) unsigned NOT NULL,
  `ad` int(5) NOT NULL DEFAULT '0',
  `group` int(5) NOT NULL DEFAULT '0',
  `block` int(5) NOT NULL DEFAULT '0',
  `user` int(5) NOT NULL DEFAULT '0',
  `schedule` int(5) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_adrotate_schedule`
--

CREATE TABLE IF NOT EXISTS `treo_adrotate_schedule` (
  `id` int(8) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `starttime` int(15) NOT NULL DEFAULT '0',
  `stoptime` int(15) NOT NULL DEFAULT '0',
  `maxclicks` int(15) NOT NULL DEFAULT '0',
  `maximpressions` int(15) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_adrotate_stats`
--

CREATE TABLE IF NOT EXISTS `treo_adrotate_stats` (
  `id` bigint(9) unsigned NOT NULL,
  `ad` int(5) NOT NULL DEFAULT '0',
  `group` int(5) NOT NULL DEFAULT '0',
  `block` int(5) NOT NULL DEFAULT '0',
  `thetime` int(15) NOT NULL DEFAULT '0',
  `clicks` int(15) NOT NULL DEFAULT '0',
  `impressions` int(15) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=778 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_adrotate_stats_tracker`
--

CREATE TABLE IF NOT EXISTS `treo_adrotate_stats_tracker` (
  `id` mediumint(8) unsigned NOT NULL,
  `ad` int(5) NOT NULL DEFAULT '0',
  `group` int(5) NOT NULL DEFAULT '0',
  `block` int(5) NOT NULL DEFAULT '0',
  `thetime` int(15) NOT NULL DEFAULT '0',
  `clicks` int(15) NOT NULL DEFAULT '0',
  `impressions` int(15) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_adrotate_tracker`
--

CREATE TABLE IF NOT EXISTS `treo_adrotate_tracker` (
  `id` bigint(9) unsigned NOT NULL,
  `ipaddress` varchar(255) NOT NULL DEFAULT '0',
  `timer` int(15) NOT NULL DEFAULT '0',
  `bannerid` int(15) NOT NULL DEFAULT '0',
  `stat` char(1) NOT NULL DEFAULT 'c',
  `useragent` mediumtext NOT NULL,
  `country` text NOT NULL,
  `city` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=24250 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_agentaccount`
--

CREATE TABLE IF NOT EXISTS `treo_agentaccount` (
  `agent_id` int(11) NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `agent_username` varchar(255) NOT NULL,
  `agent_password` varchar(255) NOT NULL,
  `agent_loginurl` text NOT NULL,
  `agent_offcode` text NOT NULL,
  `db` varchar(100) NOT NULL,
  `db_user` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `host` varchar(100) NOT NULL,
  `address` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `treo_commentmeta`
--

CREATE TABLE IF NOT EXISTS `treo_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_comments`
--

CREATE TABLE IF NOT EXISTS `treo_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_expire_check`
--

CREATE TABLE IF NOT EXISTS `treo_expire_check` (
  `ID` bigint(10) NOT NULL,
  `last_check` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `treo_links`
--

CREATE TABLE IF NOT EXISTS `treo_links` (
  `link_id` bigint(20) unsigned NOT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_options`
--

CREATE TABLE IF NOT EXISTS `treo_options` (
  `option_id` bigint(20) unsigned NOT NULL,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM AUTO_INCREMENT=23764 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_packages`
--

CREATE TABLE IF NOT EXISTS `treo_packages` (
  `ID` bigint(20) NOT NULL,
  `pkg_type` varchar(25) NOT NULL,
  `pkg_price` double NOT NULL,
  `pkg_cycle` varchar(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `treo_pdfpaypal`
--

CREATE TABLE IF NOT EXISTS `treo_pdfpaypal` (
  `pid` int(12) NOT NULL,
  `pdf_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stamping_start` int(8) DEFAULT NULL,
  `fontcolor` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fontstyle` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fontsize` int(5) DEFAULT NULL,
  `textalign` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `utf8` tinyint(1) DEFAULT '0',
  `linedistance` int(5) DEFAULT NULL,
  `linespacing` int(5) DEFAULT NULL,
  `footertext` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_settings` longtext COLLATE utf8_unicode_ci,
  `encrypt` longtext COLLATE utf8_unicode_ci,
  `clickbank` longtext COLLATE utf8_unicode_ci,
  `email_settings` longtext COLLATE utf8_unicode_ci
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `treo_pdfpaypal_sales`
--

CREATE TABLE IF NOT EXISTS `treo_pdfpaypal_sales` (
  `id` int(5) NOT NULL,
  `item` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `transaction` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `fullname` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gateway` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `pdf_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pdf_file` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `treo_postmeta`
--

CREATE TABLE IF NOT EXISTS `treo_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM AUTO_INCREMENT=827 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_posts`
--

CREATE TABLE IF NOT EXISTS `treo_posts` (
  `ID` bigint(20) unsigned NOT NULL,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=468 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_seo_title_tag_category`
--

CREATE TABLE IF NOT EXISTS `treo_seo_title_tag_category` (
  `id` bigint(11) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_seo_title_tag_tag`
--

CREATE TABLE IF NOT EXISTS `treo_seo_title_tag_tag` (
  `id` bigint(11) NOT NULL,
  `tag_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_seo_title_tag_url`
--

CREATE TABLE IF NOT EXISTS `treo_seo_title_tag_url` (
  `id` bigint(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_terms`
--

CREATE TABLE IF NOT EXISTS `treo_terms` (
  `term_id` bigint(20) unsigned NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_term_relationships`
--

CREATE TABLE IF NOT EXISTS `treo_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `treo_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_usermeta`
--

CREATE TABLE IF NOT EXISTS `treo_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM AUTO_INCREMENT=12847 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treo_users`
--

CREATE TABLE IF NOT EXISTS `treo_users` (
  `ID` bigint(20) unsigned NOT NULL,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=1043 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zip_look_up`
--

CREATE TABLE IF NOT EXISTS `zip_look_up` (
  `zip` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(4) DEFAULT NULL,
  `latitude` varchar(25) DEFAULT NULL,
  `longitude` varchar(25) DEFAULT NULL,
  `timezone` varchar(25) DEFAULT NULL,
  `dst` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additionalinfo`
--
ALTER TABLE `additionalinfo`
  ADD PRIMARY KEY (`id`), ADD KEY `nid` (`nid`), ADD KEY `N_id` (`n_id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agentsimage`
--
ALTER TABLE `agentsimage`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `austinmaping`
--
ALTER TABLE `austinmaping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `city_old`
--
ALTER TABLE `city_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `county`
--
ALTER TABLE `county`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financial`
--
ALTER TABLE `financial`
  ADD PRIMARY KEY (`id`), ADD KEY `n_id` (`n_id`);

--
-- Indexes for table `ip_blocks`
--
ALTER TABLE `ip_blocks`
  ADD KEY `start` (`startIpNum`), ADD KEY `end` (`endIpNum`), ADD KEY `loc` (`locId`);

--
-- Indexes for table `ip_location`
--
ALTER TABLE `ip_location`
  ADD PRIMARY KEY (`locId`);

--
-- Indexes for table `lastmodified`
--
ALTER TABLE `lastmodified`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ntreisimages`
--
ALTER TABLE `ntreisimages`
  ADD PRIMARY KEY (`id`), ADD KEY `mlsnum` (`mlsnum`), ADD KEY `n_id` (`n_id`);

--
-- Indexes for table `ntreislist`
--
ALTER TABLE `ntreislist`
  ADD PRIMARY KEY (`id`), ADD KEY `MLS` (`MLS`), ADD KEY `rets_area` (`rets_area`,`MLS`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sabormaping`
--
ALTER TABLE `sabormaping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_searches`
--
ALTER TABLE `saved_searches`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `treo_accounts`
--
ALTER TABLE `treo_accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `treo_account_items`
--
ALTER TABLE `treo_account_items`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `treo_adrotate`
--
ALTER TABLE `treo_adrotate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treo_adrotate_blocks`
--
ALTER TABLE `treo_adrotate_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treo_adrotate_groups`
--
ALTER TABLE `treo_adrotate_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treo_adrotate_linkmeta`
--
ALTER TABLE `treo_adrotate_linkmeta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treo_adrotate_schedule`
--
ALTER TABLE `treo_adrotate_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treo_adrotate_stats`
--
ALTER TABLE `treo_adrotate_stats`
  ADD PRIMARY KEY (`id`), ADD KEY `ad` (`ad`);

--
-- Indexes for table `treo_adrotate_stats_tracker`
--
ALTER TABLE `treo_adrotate_stats_tracker`
  ADD PRIMARY KEY (`id`), ADD KEY `ad` (`ad`);

--
-- Indexes for table `treo_adrotate_tracker`
--
ALTER TABLE `treo_adrotate_tracker`
  ADD PRIMARY KEY (`id`), ADD KEY `ipaddress` (`ipaddress`), ADD KEY `timer` (`timer`);

--
-- Indexes for table `treo_agentaccount`
--
ALTER TABLE `treo_agentaccount`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `treo_commentmeta`
--
ALTER TABLE `treo_commentmeta`
  ADD PRIMARY KEY (`meta_id`), ADD KEY `comment_id` (`comment_id`), ADD KEY `meta_key` (`meta_key`);

--
-- Indexes for table `treo_comments`
--
ALTER TABLE `treo_comments`
  ADD PRIMARY KEY (`comment_ID`), ADD KEY `comment_post_ID` (`comment_post_ID`), ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`), ADD KEY `comment_date_gmt` (`comment_date_gmt`), ADD KEY `comment_parent` (`comment_parent`);

--
-- Indexes for table `treo_expire_check`
--
ALTER TABLE `treo_expire_check`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `treo_links`
--
ALTER TABLE `treo_links`
  ADD PRIMARY KEY (`link_id`), ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `treo_options`
--
ALTER TABLE `treo_options`
  ADD PRIMARY KEY (`option_id`), ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `treo_packages`
--
ALTER TABLE `treo_packages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `treo_pdfpaypal`
--
ALTER TABLE `treo_pdfpaypal`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `treo_pdfpaypal_sales`
--
ALTER TABLE `treo_pdfpaypal_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treo_postmeta`
--
ALTER TABLE `treo_postmeta`
  ADD PRIMARY KEY (`meta_id`), ADD KEY `post_id` (`post_id`), ADD KEY `meta_key` (`meta_key`);

--
-- Indexes for table `treo_posts`
--
ALTER TABLE `treo_posts`
  ADD PRIMARY KEY (`ID`), ADD KEY `post_name` (`post_name`), ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`), ADD KEY `post_parent` (`post_parent`), ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `treo_seo_title_tag_category`
--
ALTER TABLE `treo_seo_title_tag_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treo_seo_title_tag_tag`
--
ALTER TABLE `treo_seo_title_tag_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treo_seo_title_tag_url`
--
ALTER TABLE `treo_seo_title_tag_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treo_terms`
--
ALTER TABLE `treo_terms`
  ADD PRIMARY KEY (`term_id`), ADD UNIQUE KEY `slug` (`slug`), ADD KEY `name` (`name`);

--
-- Indexes for table `treo_term_relationships`
--
ALTER TABLE `treo_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`), ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `treo_term_taxonomy`
--
ALTER TABLE `treo_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`), ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`), ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `treo_usermeta`
--
ALTER TABLE `treo_usermeta`
  ADD PRIMARY KEY (`umeta_id`), ADD KEY `user_id` (`user_id`), ADD KEY `meta_key` (`meta_key`);

--
-- Indexes for table `treo_users`
--
ALTER TABLE `treo_users`
  ADD PRIMARY KEY (`ID`), ADD KEY `user_login_key` (`user_login`), ADD KEY `user_nicename` (`user_nicename`);

--
-- Indexes for table `zip_look_up`
--
ALTER TABLE `zip_look_up`
  ADD UNIQUE KEY `zip_look_up` (`zip`), ADD KEY `city` (`city`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additionalinfo`
--
ALTER TABLE `additionalinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=399957;
--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=425;
--
-- AUTO_INCREMENT for table `agentsimage`
--
ALTER TABLE `agentsimage`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `austinmaping`
--
ALTER TABLE `austinmaping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1352;
--
-- AUTO_INCREMENT for table `city_old`
--
ALTER TABLE `city_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=965;
--
-- AUTO_INCREMENT for table `county`
--
ALTER TABLE `county`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=257;
--
-- AUTO_INCREMENT for table `financial`
--
ALTER TABLE `financial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1810;
--
-- AUTO_INCREMENT for table `lastmodified`
--
ALTER TABLE `lastmodified`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `ntreisimages`
--
ALTER TABLE `ntreisimages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8264943;
--
-- AUTO_INCREMENT for table `ntreislist`
--
ALTER TABLE `ntreislist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=478829;
--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sabormaping`
--
ALTER TABLE `sabormaping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `saved_searches`
--
ALTER TABLE `saved_searches`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `treo_accounts`
--
ALTER TABLE `treo_accounts`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=353;
--
-- AUTO_INCREMENT for table `treo_account_items`
--
ALTER TABLE `treo_account_items`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=785;
--
-- AUTO_INCREMENT for table `treo_adrotate`
--
ALTER TABLE `treo_adrotate`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `treo_adrotate_blocks`
--
ALTER TABLE `treo_adrotate_blocks`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `treo_adrotate_groups`
--
ALTER TABLE `treo_adrotate_groups`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `treo_adrotate_linkmeta`
--
ALTER TABLE `treo_adrotate_linkmeta`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `treo_adrotate_schedule`
--
ALTER TABLE `treo_adrotate_schedule`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `treo_adrotate_stats`
--
ALTER TABLE `treo_adrotate_stats`
  MODIFY `id` bigint(9) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=778;
--
-- AUTO_INCREMENT for table `treo_adrotate_stats_tracker`
--
ALTER TABLE `treo_adrotate_stats_tracker`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `treo_adrotate_tracker`
--
ALTER TABLE `treo_adrotate_tracker`
  MODIFY `id` bigint(9) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24250;
--
-- AUTO_INCREMENT for table `treo_agentaccount`
--
ALTER TABLE `treo_agentaccount`
  MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `treo_commentmeta`
--
ALTER TABLE `treo_commentmeta`
  MODIFY `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `treo_comments`
--
ALTER TABLE `treo_comments`
  MODIFY `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `treo_expire_check`
--
ALTER TABLE `treo_expire_check`
  MODIFY `ID` bigint(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `treo_links`
--
ALTER TABLE `treo_links`
  MODIFY `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `treo_options`
--
ALTER TABLE `treo_options`
  MODIFY `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23764;
--
-- AUTO_INCREMENT for table `treo_packages`
--
ALTER TABLE `treo_packages`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `treo_pdfpaypal`
--
ALTER TABLE `treo_pdfpaypal`
  MODIFY `pid` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `treo_pdfpaypal_sales`
--
ALTER TABLE `treo_pdfpaypal_sales`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `treo_postmeta`
--
ALTER TABLE `treo_postmeta`
  MODIFY `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=827;
--
-- AUTO_INCREMENT for table `treo_posts`
--
ALTER TABLE `treo_posts`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=468;
--
-- AUTO_INCREMENT for table `treo_seo_title_tag_category`
--
ALTER TABLE `treo_seo_title_tag_category`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `treo_seo_title_tag_tag`
--
ALTER TABLE `treo_seo_title_tag_tag`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `treo_seo_title_tag_url`
--
ALTER TABLE `treo_seo_title_tag_url`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `treo_terms`
--
ALTER TABLE `treo_terms`
  MODIFY `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `treo_term_taxonomy`
--
ALTER TABLE `treo_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `treo_usermeta`
--
ALTER TABLE `treo_usermeta`
  MODIFY `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12847;
--
-- AUTO_INCREMENT for table `treo_users`
--
ALTER TABLE `treo_users`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1043;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
