# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.6.5](https://github.com/loophp/phptree/compare/2.6.4...2.6.5)

### Commits

- Revert "fix: Add new parameter to dot command." [`0e46a87`](https://github.com/loophp/phptree/commit/0e46a8722e646126e1747463b51a6ae8ec7e4b75)

## [2.6.4](https://github.com/loophp/phptree/compare/2.6.3...2.6.4) - 2020-10-28

### Merged

- fix: Add new parameter to dot command. [`#20`](https://github.com/loophp/phptree/pull/20)

### Commits

- docs: Update changelog. [`345042b`](https://github.com/loophp/phptree/commit/345042bcb596327848ea25be71cddcf4c014db21)
- chore: Update composer.json. [`7775d49`](https://github.com/loophp/phptree/commit/7775d49beb64bf298e48ad2c459d66bb99ac014d)
- ci: Drop support of PHP 7.1 in CI only for now. [`7725071`](https://github.com/loophp/phptree/commit/77250715592bef0aeb939bf948b0431c56f67e61)
- docs: Update README, add link to changelog. [`64ba104`](https://github.com/loophp/phptree/commit/64ba104c3fa09bba62a4c2c050be9b872c149634)
- docs: Add CHANGELOG.md file [`ce93ce8`](https://github.com/loophp/phptree/commit/ce93ce8e169f7d13aa9adcc80e0d83cf0aec9a9d)
- ci: Update Github actions configuration [`c4cde82`](https://github.com/loophp/phptree/commit/c4cde82285440f544bd7339ab12a768fe04194ef)
- Fix CS. [`045936a`](https://github.com/loophp/phptree/commit/045936a30125f77ffee17823fd42c6035ad3146b)
- Enable Psalm, Infection and Insights reports. [`4edfd8f`](https://github.com/loophp/phptree/commit/4edfd8fdb21119138a9fef4b82110f067f03ee36)
- Fix PHPStan warning. [`04a3450`](https://github.com/loophp/phptree/commit/04a3450906d488111b967222b423edaf6fc519a5)
- Update code style. [`97996be`](https://github.com/loophp/phptree/commit/97996bedc810abf927ce8d9135eabab5b6fc2e96)
- Increase test coverage. [`3b879f0`](https://github.com/loophp/phptree/commit/3b879f08b3c2ccd1e4395f4839ed38ab24dc402f)
- Fix Windows builds. [`463c24c`](https://github.com/loophp/phptree/commit/463c24c2160f9eb44f077ee82d263d1d252bf840)

## [2.6.3](https://github.com/loophp/phptree/compare/2.6.2...2.6.3) - 2020-03-11

### Commits

- Update Scrutinizer configuration. [`a474424`](https://github.com/loophp/phptree/commit/a474424d8dd04b2728a0c1c6ae91eb27551e3609)
- Update codebase using rector/rector. [`03d63ec`](https://github.com/loophp/phptree/commit/03d63ecdb9605a9547e580a38681b5e2c2c82e4d)
- Optimize Exporters. [`d03f537`](https://github.com/loophp/phptree/commit/d03f5373e1933c42047f97abcf289c8e12a74af1)
- Update Exporters, remove obsolete AbstractExporter. [`e43a16c`](https://github.com/loophp/phptree/commit/e43a16c6e0f024a04432f6ce983913d17e57aaed)
- Update Graph tests. [`29f04e9`](https://github.com/loophp/phptree/commit/29f04e9c0db3eb782a108b66a9d59f1a1c3d11a7)
- Refactor remaining Importers. [`77eb6b9`](https://github.com/loophp/phptree/commit/77eb6b999bc7bb6e967a97eed0b470401c3d60a6)
- Refactor Importers tests. [`2096a62`](https://github.com/loophp/phptree/commit/2096a62ab90e141648a8d580d38691cd8542b2bf)
- Add method AttributeNode::label(). [`46724eb`](https://github.com/loophp/phptree/commit/46724eb156f92bb4d60a9917b52b0dbbb4321532)
- Enable ast extension in continuous integration. [`4ffc86e`](https://github.com/loophp/phptree/commit/4ffc86e3944aa8584e08ad5d6cbcb251c57dc2f5)
- Enable ast extension in continuous integration. [`0a26dd5`](https://github.com/loophp/phptree/commit/0a26dd5dea04cca02f0039729e24e1748c5e9a03)

## [2.6.2](https://github.com/loophp/phptree/compare/2.6.1...2.6.2) - 2020-03-06

### Commits

- Refactor nikic/php-parser importer. [`b7b76b5`](https://github.com/loophp/phptree/commit/b7b76b56a78a7da011521502ddc263355f58920a)
- Add a new Importer nikic/php-ast. [`fbe967e`](https://github.com/loophp/phptree/commit/fbe967ed118d3bc3c81d33b92bdfd64d4a494750)

## [2.6.1](https://github.com/loophp/phptree/compare/2.6.0...2.6.1) - 2020-03-04

### Commits

- Add new microsoft/tolerant-php-parser importer. [`37b4c70`](https://github.com/loophp/phptree/commit/37b4c70702396d102fba7f9ef5b1f2aba5c25e63)
- Update the nikic/php-parser importer. [`968e58e`](https://github.com/loophp/phptree/commit/968e58ed66e92490ccb3c44d30218e0cb7415aea)
- Update the README accordingly. [`8352667`](https://github.com/loophp/phptree/commit/835266728ab060c0ca1c45262f004ce0ac80343b)
- Simplify the exporters. [`0ef60e9`](https://github.com/loophp/phptree/commit/0ef60e9b0afd222ea11e11e8fc98ddb13dc11e3c)

## [2.6.0](https://github.com/loophp/phptree/compare/2.5.0...2.6.0) - 2020-03-02

### Commits

- Minor phpdoc change. [`d71011e`](https://github.com/loophp/phptree/commit/d71011e9938060dfcfa21015b78951b95fb5ceb8)
- Minor optimization change in the Filter modifier. [`2a9104c`](https://github.com/loophp/phptree/commit/2a9104caa4d585a24422ff38935f653c55a3fd96)
- Minor refactoring. [`355cc74`](https://github.com/loophp/phptree/commit/355cc744dcc227cf434f3f5b964230599e6a6497)
- Rewrite of the if statement. [`fd4af8e`](https://github.com/loophp/phptree/commit/fd4af8e6e1dea61c1d72e932eec4095d5aa67f58)
- Add Node::replace() method. [`2862d4f`](https://github.com/loophp/phptree/commit/2862d4f11cba8e0a6865d03111284c4a26cab37f)
- Optimize the Modifier now that we use Post-Order method by default. [`90eef49`](https://github.com/loophp/phptree/commit/90eef49be27cac280a44c5f794b140a4321f309b)
- Let Modifiers use a customizable traverser. [`d5f140f`](https://github.com/loophp/phptree/commit/d5f140f1b332a404e79a18293aaafb090cd1f97b)
- Add missing PHP extension in Github CI. [`6c214fb`](https://github.com/loophp/phptree/commit/6c214fb0d27170093395ccade1b3407c5111ac05)
- Update composer.json. [`6a63d5c`](https://github.com/loophp/phptree/commit/6a63d5c68eab12e33e7bd0076531cbf19ae0f2b5)
- Fix small bug in NaryNode. [`4c8cf5a`](https://github.com/loophp/phptree/commit/4c8cf5a0d31a9b0baac482942377bbdb9a744b17)
- Update GV exporter, do not export attributes that are not "Stringable". [`5e94567`](https://github.com/loophp/phptree/commit/5e9456736259b5d23324ea55520d93086809ffb2)
- Add nikic/php-parser importer. [`eeded27`](https://github.com/loophp/phptree/commit/eeded2730683b2f60a4370628d4a273fdfc12ce2)
- Add new Filter modifier. [`c20db13`](https://github.com/loophp/phptree/commit/c20db13137488f95139ee7fdee6436bb555363ac)
- Add new Apply modifier. [`24e6d45`](https://github.com/loophp/phptree/commit/24e6d459a5ebfd5f115bb7b660fd6c9e919ff3b9)
- Minor optimizations and rephrases. [`28c5ec1`](https://github.com/loophp/phptree/commit/28c5ec1d73a9decf7714ee3c954ce243e2b3b93c)
- Update Github settings. [`f34576f`](https://github.com/loophp/phptree/commit/f34576f59fa579ace6d7b6836393da0734c15ebd)

## [2.5.0](https://github.com/loophp/phptree/compare/2.4.4...2.5.0) - 2020-01-01

### Commits

- Switch to https://github.com/loophp. [`6c0cb80`](https://github.com/loophp/phptree/commit/6c0cb80e515b04f569481ddd5da40cf29fedca33)
- Bump version. [`4a4b292`](https://github.com/loophp/phptree/commit/4a4b292376a5a566b6750a73b8f634634df63114)
- Use ValueNode in the SimpleArray importer. [`3c014af`](https://github.com/loophp/phptree/commit/3c014afab1c1b638158ce288c9484905d1e355b5)
- Use ValueNode in the SimpleArray importer. [`bcf664b`](https://github.com/loophp/phptree/commit/bcf664b64f1f0529906c31f4486d120616f6fa8c)
- Add new method NodeInterface::label() so I can fix the MerkleNode properly. [`9eecefa`](https://github.com/loophp/phptree/commit/9eecefa23a4bcc64bca75692dca99fe7013c07e4)
- Fix minor things. [`a282a07`](https://github.com/loophp/phptree/commit/a282a079b3d16f4ce763a4b52e13d37bee8cbba5)
- Remove the parent when checking from null value nodes as well if needed. [`af62cef`](https://github.com/loophp/phptree/commit/af62cef67c5d9a4015cfa0e4bb9ed44577dbc700)
- Remove Storage classes. [`0396b41`](https://github.com/loophp/phptree/commit/0396b41dab0d44e4417ff376d345ffbfd6aaee04)
- Fix tests. [`24d492a`](https://github.com/loophp/phptree/commit/24d492a44c66734c984b82f8444df739910a5c8e)
- Update phpdoc to fix PHPStan errors. [`c7ed6a2`](https://github.com/loophp/phptree/commit/c7ed6a2b6ee2acd317d205864e9bff2be7f57102)
- Update code style. [`8ba6d21`](https://github.com/loophp/phptree/commit/8ba6d21ea017d2dfcb0f7937b0a02c307311cd9f)
- Add new method NodeInterface::level() and its tests. [`7ffd252`](https://github.com/loophp/phptree/commit/7ffd2522793383547d3ed3cc2c550c819034b289)
- Add Random builder. [`ebbb505`](https://github.com/loophp/phptree/commit/ebbb50567279c418253a7e4f2676471297638fd3)
- Add tests. [`79fd15b`](https://github.com/loophp/phptree/commit/79fd15be6cfb2c686382ce83caab1dce67394f64)
- Add BuilderInterface.php. [`37e93cc`](https://github.com/loophp/phptree/commit/37e93ccc15eab9b8108fc825564d8d37b914d56b)
- Update MerkleNode. [`8c29f58`](https://github.com/loophp/phptree/commit/8c29f58725c0c09d8c4a6c8419d4b82eef05e8d5)
- Disable CI using lowest deps for now. [`2adb9e8`](https://github.com/loophp/phptree/commit/2adb9e8e6ddae3f5d13b39bb57ebc9928604b51c)
- Use Node::clone() method in order to not alter the original tree when getting using Node::getValue(). [`b196a1a`](https://github.com/loophp/phptree/commit/b196a1ad675221bfaab6260592191a6106d72017)
- Update README.md. [`4589580`](https://github.com/loophp/phptree/commit/45895809af5c404fad22b8b7169d63522b6027c6)
- Add MerkleNode and its tests. [`98ec062`](https://github.com/loophp/phptree/commit/98ec062bbb76af1924f4d4eae51591312d19f19a)
- Update CS and static files. [`660dd9a`](https://github.com/loophp/phptree/commit/660dd9a01e6a4d98a7aab4ec110f08a6d5f82a3f)
- Update README code example. [`966b1ee`](https://github.com/loophp/phptree/commit/966b1eebd699e8d41c90419f6887f797920332c4)
- Update to newest drupol/php-conventions. [`63a4e73`](https://github.com/loophp/phptree/commit/63a4e73d77af4d90d40c24508ec22784558acdf3)
- Update composer.json. [`b1e3dc5`](https://github.com/loophp/phptree/commit/b1e3dc537f5431480799a4e3f8719beff483422d)
- Upgrade to drupol/php-conventions ^1.4. [`6d5ee28`](https://github.com/loophp/phptree/commit/6d5ee28e7edbdc219eec01183738411aae9bba6d)
- Add Github files. [`efa2d7d`](https://github.com/loophp/phptree/commit/efa2d7dce10356b6dfdefb1ea2954a347c647bb6)
- Update badges. [`d6eb330`](https://github.com/loophp/phptree/commit/d6eb33059f82f654daa5f21c0ea7b08545362b1e)
- Use a fork of leanphp/phpspec-code-coverage to have code coverage with PHPSpec &gt;= 5. [`a8ab11b`](https://github.com/loophp/phptree/commit/a8ab11b9f638c7bd5071d05ba33c613509eb4516)
- Update composer.json. [`3930397`](https://github.com/loophp/phptree/commit/393039772f3700a882873e0b1be58342182997bb)
- Add an abstracted exporter class to reduce duplicated code and allow customizations. [`e5ed8cf`](https://github.com/loophp/phptree/commit/e5ed8cfe7cfe09125221e6f37c6ca6cc9b4b9d63)

## [2.4.4](https://github.com/loophp/phptree/compare/2.4.3...2.4.4) - 2019-07-02

### Commits

- Rename GvConvert to Image. [`b941eb9`](https://github.com/loophp/phptree/commit/b941eb95dc07ff145db0504f6eddb86cfe63a44a)

## [2.4.3](https://github.com/loophp/phptree/compare/2.4.2...2.4.3) - 2019-07-02

### Commits

- Update the GraphViz exporter so it's easy to override Gv::getNodeAttributes(). [`f01c36a`](https://github.com/loophp/phptree/commit/f01c36a6c2a7bf0a6a7ca503169a9fc46ba93cd5)
- Update README file. [`f5790eb`](https://github.com/loophp/phptree/commit/f5790eb5d79894612f2f086843a24ff2c6963e35)

## [2.4.2](https://github.com/loophp/phptree/compare/2.4.1...2.4.2) - 2019-07-02

### Commits

- Add a new exporter GvConvert to export a Graphviz script into another format. [`aaa6af7`](https://github.com/loophp/phptree/commit/aaa6af775fec09bbc226ceb10ec0ce407a761e26)

## [2.4.1](https://github.com/loophp/phptree/compare/2.4.0...2.4.1) - 2019-06-28

### Merged

- Add a GraphViz GV exporter. [`#14`](https://github.com/loophp/phptree/pull/14)
- Add an AttributeNode node type. [`#13`](https://github.com/loophp/phptree/pull/13)

### Commits

- Add more documentation for the Attribute node. [`5ba5f85`](https://github.com/loophp/phptree/commit/5ba5f854ddcf2e202985bcab4f622f2c51fb99d7)
- Improve the Ascii exporter. [`6215ceb`](https://github.com/loophp/phptree/commit/6215cebd08151e11972a9a0d8036526236d362e4)
- Let user customize the Ascii exporter. [`36f7be7`](https://github.com/loophp/phptree/commit/36f7be70ae0ea84c05345581e2b6c8f7dcf9a717)
- Update code on GraphViz exporter based on Scrutinizer analysis. [`4c23013`](https://github.com/loophp/phptree/commit/4c2301345f85328b425f7cd128354b083180f737)
- Enable Infection in Grumphp. [`9938e31`](https://github.com/loophp/phptree/commit/9938e31277348d70d3045d7a4366fc46628a1d48)
- Fix code-style and tests. [`d9ba43e`](https://github.com/loophp/phptree/commit/d9ba43edabd3935fc4ee601a561ad2aab58f669d)
- Update documentation and code style. [`9940b9a`](https://github.com/loophp/phptree/commit/9940b9a24f95281e97b2dd38c453777ade92692d)
- Update documentation and code style. [`f75af46`](https://github.com/loophp/phptree/commit/f75af46f93b76df42d34d17fdb24d1f20eb33f3e)
- Fix code style. [`783703c`](https://github.com/loophp/phptree/commit/783703cff4990e0dcdbc2be8bd64e2297e73b944)
- Make sur AttributeNode attributes are used when exporting to a Graph. [`f17f567`](https://github.com/loophp/phptree/commit/f17f567f249e93935010f15763edace6d1d432b2)
- Reduce duplicated code. [`a3cef6e`](https://github.com/loophp/phptree/commit/a3cef6ecbdac0e74b7a612c6a91e764eab187041)

## [2.4.0](https://github.com/loophp/phptree/compare/2.3.2...2.4.0) - 2019-06-15

### Merged

- Issue #7: Trying to fix png image generation on Travis. [`#8`](https://github.com/loophp/phptree/pull/8)
- Issue #8: Remove the space between elements. [`#10`](https://github.com/loophp/phptree/pull/10)

### Commits

- Issue #12: Consistency in constructor arguments. [`e543e7b`](https://github.com/loophp/phptree/commit/e543e7b3c057b24b550e376c1f976b73e0f74132)
- Issue #11: Improve the NaryNode. [`c3de5fc`](https://github.com/loophp/phptree/commit/c3de5fce303c2c05a104718052e25ad2909fc255)
- Update tests of Text importer. [`1ce4437`](https://github.com/loophp/phptree/commit/1ce443738e231f58649e480160eb4b5f8d7b7802)
- Update the README file based on latest changes on Text exporter. [`1d45cc0`](https://github.com/loophp/phptree/commit/1d45cc0bdde3aa003e41b49ab5933df402877558)
- Try to fix tests on Travis. [`a969acd`](https://github.com/loophp/phptree/commit/a969acde6ab10bda03b0a6b9bf06eaa264243090)
- Try to fix tests on Travis. [`97ce53b`](https://github.com/loophp/phptree/commit/97ce53b7289671a7716fdfa181bcbea2df45daa5)
- Install Graphviz on Travis. [`21829da`](https://github.com/loophp/phptree/commit/21829da1f4ef591264d272d764f0f90653255cd4)
- Improve the way graphs are compared using images. [`3ad4b8b`](https://github.com/loophp/phptree/commit/3ad4b8bec495a352be91d0ccad505a724c0f55a4)
- Issue #6: Replace unserialize() and serialize() with proper clone calls. [`7be956b`](https://github.com/loophp/phptree/commit/7be956be00397e76bb7d9ac9fcda27d54b2a3cbd)
- Optimize the Graph exporter. [`d71bcb1`](https://github.com/loophp/phptree/commit/d71bcb1503c5c3ba2749c1237b199e91ea394fe8)
- Add a NodeInterface::clone() method. [`6fd1ed1`](https://github.com/loophp/phptree/commit/6fd1ed1837ff924b4414b2ba3de3efa8b1f8d1d8)
- Update README file. [`f073959`](https://github.com/loophp/phptree/commit/f0739596f73644b7917bbf52699f94c8b8497319)
- Update KeyValueGraph exporter. [`0b1717d`](https://github.com/loophp/phptree/commit/0b1717d52d6ee49a823c03a780a31f0b7a4d5da7)
- Add an Auto Balanced Node. [`eb4efa8`](https://github.com/loophp/phptree/commit/eb4efa8594cac851b87bc4609e1a201ea05a3990)
- Remove ValueGraph. [`eb0e182`](https://github.com/loophp/phptree/commit/eb0e182ab30227d620fdf0644e4e3b11cf74e019)
- Use iterator_count() instead of a foreach loop. [`a95215f`](https://github.com/loophp/phptree/commit/a95215f8936c758a31a9d36a91c88918285b5c62)
- Update NaryNode and the way nodes are added. [`43da343`](https://github.com/loophp/phptree/commit/43da3432b6d2636e907e21c8fc442bffd6ddee58)
- Restore the way the graph exporter was working before. [`5712df1`](https://github.com/loophp/phptree/commit/5712df1eb97b41408ddb7574f1f6de0d1b5dea9f)
- Add NodeInterface::all(), NodeInterface::find() and NodeInterface::delete(). [`ece93d8`](https://github.com/loophp/phptree/commit/ece93d8e03ee9b07778be3c8e6bcce0629efeea2)
- Update the Graph exporter base class. [`1334ba8`](https://github.com/loophp/phptree/commit/1334ba85247f9f262b22b680c07611b85de052cf)
- Remove obsolete method. [`b7d6b90`](https://github.com/loophp/phptree/commit/b7d6b90e7f3ef5fe85c05d13de4225e5409180ba)
- Increase tests coverage. [`5178e8e`](https://github.com/loophp/phptree/commit/5178e8e7455b572dec7889e6bd8d865f5fb9ee1e)
- Use a dedicated Storage class. [`3fd3392`](https://github.com/loophp/phptree/commit/3fd3392b360ce67646f52261df84918aa5d3491c)

## [2.3.2](https://github.com/loophp/phptree/compare/2.3.1...2.3.2) - 2019-06-05

### Commits

- Increase tests coverage. [`953412a`](https://github.com/loophp/phptree/commit/953412a8eb77cf8daf88f0b3011b1708871f8db4)
- Now NodeInterface extends from IteratorAggregate and Traversable. [`170ed5f`](https://github.com/loophp/phptree/commit/170ed5f533bd94c1e178b4b1feff3688d94ac3e1)

## [2.3.1](https://github.com/loophp/phptree/compare/2.3.0...2.3.1) - 2019-06-04

### Commits

- Enable PHPSpec in GrumPHP. [`0a4587a`](https://github.com/loophp/phptree/commit/0a4587a1381d6f1e145b29e760ab21b31d340ed9)
- Fix PHPStan errors. [`0ff1ff7`](https://github.com/loophp/phptree/commit/0ff1ff7fd6ac183b265a5de6ed99dc3bf761f46c)
- NodeInterface now extends \ArrayAccess interface. [`2fd392d`](https://github.com/loophp/phptree/commit/2fd392dea446176da74ce83fed15465819cf1374)

## [2.3.0](https://github.com/loophp/phptree/compare/2.2.9...2.3.0) - 2019-05-02

### Commits

- Update badges look'n'feel. [`d27edfe`](https://github.com/loophp/phptree/commit/d27edfe72162e208bf41487193f527161768206c)
- Update badges look'n'feel. [`98e51b0`](https://github.com/loophp/phptree/commit/98e51b05aeef31561e7bcf8cf506957214d06d08)
- Update README file. [`ee4fc8b`](https://github.com/loophp/phptree/commit/ee4fc8b62bfd96318919aaefce91e510b8c2f02a)
- Update README file. [`8c0e47f`](https://github.com/loophp/phptree/commit/8c0e47f582c6e2f90aa3c99d93f1d3648d0acde6)
- Remove obsolete static file. [`6b74f6c`](https://github.com/loophp/phptree/commit/6b74f6c75a066c45af14eb06d8c9fff3e0c97471)
- Update scrutinizer configuration. [`55fa6fe`](https://github.com/loophp/phptree/commit/55fa6fe80c33dc5600bccbe89bf567fc56ddda0c)
- Update tests. [`437397f`](https://github.com/loophp/phptree/commit/437397fa1e64c347b0c2bf6846537385c0d87433)
- Make sure that parent vertex exist. [`f1ecb6a`](https://github.com/loophp/phptree/commit/f1ecb6a19a491a8caf8fb77a7f2f19c70619c2ea)
- Update NaryNode - make it simpler and cleaner. [`bb6e292`](https://github.com/loophp/phptree/commit/bb6e29260d15e72e68dd3285f50963c74f393a1f)
- Make sure a ValueNode always has a value. [`d8d70f7`](https://github.com/loophp/phptree/commit/d8d70f73c85a8068d02c2caeaf6e0a3d637a28c2)
- Make sure interface extends parent interface. [`4488f3c`](https://github.com/loophp/phptree/commit/4488f3c9e199233d07706fdbbeafb7e4e959914a)
- Update composer.json. [`31e51ce`](https://github.com/loophp/phptree/commit/31e51ceeafaea8d10d9fb16210b402eb0814c15f)
- Update git ignore file. [`c2b558b`](https://github.com/loophp/phptree/commit/c2b558b11d6998ab663f9805f32b21db3acff322)
- Test PHP 7.3 [`55568a1`](https://github.com/loophp/phptree/commit/55568a1e0e2ef5cec6868b321e9658fd90bbecee)
- Remove apigen doc deployment. [`a4bd5df`](https://github.com/loophp/phptree/commit/a4bd5df8821677a08a6d65fd6418b50980ce3a00)

## [2.2.9](https://github.com/loophp/phptree/compare/2.2.8...2.2.9) - 2019-02-16

### Commits

- Update composer.json. [`468e823`](https://github.com/loophp/phptree/commit/468e823431a4f2c1b9ed607fc43e283962d11d1b)

## [2.2.8](https://github.com/loophp/phptree/compare/2.2.7...2.2.8) - 2019-02-16

### Commits

- Update composer.json and code style. [`d3198cf`](https://github.com/loophp/phptree/commit/d3198cf8be93057c2cf26d84d9bd9e5b25c36b4f)

## [2.2.7](https://github.com/loophp/phptree/compare/2.2.6...2.2.7) - 2019-02-02

### Commits

- Update composer.json config. [`781efac`](https://github.com/loophp/phptree/commit/781efacdfcd679b9c9e90c0e6c212bbc182793c6)

## [2.2.6](https://github.com/loophp/phptree/compare/2.2.5...2.2.6) - 2019-02-02

### Commits

- Update composer.json config. [`93e562b`](https://github.com/loophp/phptree/commit/93e562b25f88e0fac387acc6f905855e10d044e5)

## [2.2.5](https://github.com/loophp/phptree/compare/2.2.4...2.2.5) - 2019-01-30

### Commits

- Update composer.json. [`23a710e`](https://github.com/loophp/phptree/commit/23a710ef3bf9c787c69cf38b62e21dc97a1a5d67)
- Fix PHPStan issue. [`61196b0`](https://github.com/loophp/phptree/commit/61196b01852e5fb1c57186cf31a427265c213e9f)
- Remove minimum-stability and prefer-stable keys. [`0d58477`](https://github.com/loophp/phptree/commit/0d58477d2259e480655cffe2eac1a4ff7f7db818)

## [2.2.4](https://github.com/loophp/phptree/compare/2.2.3...2.2.4) - 2019-01-23

### Commits

- Update code style based on new coding style conventions. [`5d70429`](https://github.com/loophp/phptree/commit/5d704298f65b1364e59c52b5c3a36597af1d7ba6)

## [2.2.3](https://github.com/loophp/phptree/compare/2.2.2...2.2.3) - 2019-01-22

### Commits

- Update code style based on new coding style conventions. [`be6778b`](https://github.com/loophp/phptree/commit/be6778b15147d0fc5e1847d06c5f17d31ac5c9f4)
- Use the new package drupol/php-conventions. [`42bf77c`](https://github.com/loophp/phptree/commit/42bf77c4dc6e76c0b7a52a282072988ffa673b89)

## [2.2.2](https://github.com/loophp/phptree/compare/2.2.1...2.2.2) - 2019-01-09

### Commits

- Optimizations. [`94eea79`](https://github.com/loophp/phptree/commit/94eea790315d254f2339a2589bca27c226c1850a)

## [2.2.1](https://github.com/loophp/phptree/compare/2.2.0...2.2.1) - 2018-12-30

### Commits

- Update README. [`fc5dbcc`](https://github.com/loophp/phptree/commit/fc5dbccebc8a21f1dd16ec3c09f01800b7633b57)
- Fix code style. [`67ddd41`](https://github.com/loophp/phptree/commit/67ddd4133a7ee04e942893f6570af35c849d9f91)
- Fix test coverage. [`2a7941c`](https://github.com/loophp/phptree/commit/2a7941c665e48c5144ff5636a3d2ccf17bd5b5f0)
- Fix PHPStan errors. [`f422c8b`](https://github.com/loophp/phptree/commit/f422c8bbfecb1a556173fea9f3a424671168558c)
- Let the NodeInterface::setParent() method accept a null parameter to remove the parent if any. [`db5f5a6`](https://github.com/loophp/phptree/commit/db5f5a68f4a49e4894735cddb610e770b7f637d1)
- Let the Graph exporter work with Node instead of ValueNode. [`87de76a`](https://github.com/loophp/phptree/commit/87de76a5e76e01b801787162dc5ff41700526cfb)
- Small code style update. [`3b9b4f7`](https://github.com/loophp/phptree/commit/3b9b4f7f87f6d49f376eea3eca7f11f9b4fd4874)
- Add a new Modifier and its tests. [`373a6f2`](https://github.com/loophp/phptree/commit/373a6f210dc04297f5eba3186df4911878998b3b)
- Add a new interface: ModifierInterface [`ad6ac2e`](https://github.com/loophp/phptree/commit/ad6ac2e4eb6ed4e03b1556654176309843d25aff)
- Add a NodeInterface::height() method and its tests. [`1218e1e`](https://github.com/loophp/phptree/commit/1218e1eeb371bb9a1936999a954d221b1061edb5)
- Add an Ascii exporter and its tests. [`b6bcc23`](https://github.com/loophp/phptree/commit/b6bcc23de38107e204d9ed7f30b4acf3c6eb9089)
- Fix documentation. [`8183ab1`](https://github.com/loophp/phptree/commit/8183ab115ca86dfb64d71993b01bf0040bd3eb94)
- Remove uneeded packages from composer.json. [`41dee53`](https://github.com/loophp/phptree/commit/41dee535970bb636dc9090a690ca7e3c0a37ffe0)

## [2.2.0](https://github.com/loophp/phptree/compare/2.1.1...2.2.0) - 2018-12-28

### Merged

- Array object and many fixes [`#5`](https://github.com/loophp/phptree/pull/5)
- Implements a new tree type: Trie [`#3`](https://github.com/loophp/phptree/pull/3)

### Commits

- Remove no longer used methods. [`478eef8`](https://github.com/loophp/phptree/commit/478eef824683a364db16cdb99ae91a4db07e2d39)
- Update NaryNodeInterface and add missing method and its documentation. [`552c0ea`](https://github.com/loophp/phptree/commit/552c0ea1fe3f996a67d5a3a1cdcc6eeb0e87ae1c)
- Update benchmarks. [`fe97ac7`](https://github.com/loophp/phptree/commit/fe97ac711d8517e3ad2f6a0deeae92c729c8cb4c)
- Update InOrder traverser. [`5ee6e1c`](https://github.com/loophp/phptree/commit/5ee6e1c9b6221a39dc5b1620c79191fff1c60c33)
- Fix typo in README. [`5889010`](https://github.com/loophp/phptree/commit/588901052dd93cc005fcdc28933a7fcef14734cf)
- Fix issue with TrieNode when value is ending with same string. [`efd938b`](https://github.com/loophp/phptree/commit/efd938be5b7c5acac34b32996d7de028d218bdbf)
- Use an ArrayObject. [`58c4ae3`](https://github.com/loophp/phptree/commit/58c4ae3f7014970184eab9488d289b6ef9c3ef1a)
- Add an array exporter and the tests. [`ba0b0b6`](https://github.com/loophp/phptree/commit/ba0b0b65c45b3cf5ef6557c1db3d758eeb80e0cd)
- Update README. [`c99db23`](https://github.com/loophp/phptree/commit/c99db23bd389d90f35de89dd0afd4196a579788b)
- Update phpdoc. [`b3bedaf`](https://github.com/loophp/phptree/commit/b3bedaf76029886b5d3b8e3aebf55b7fdc7e85f2)
- Add a KeyValueGraph test class for displaying graphs with a key and a value. [`9dfd69d`](https://github.com/loophp/phptree/commit/9dfd69ddc6f305dc626f254ec5d6a80ab3741c99)
- Add related tests. [`d1658da`](https://github.com/loophp/phptree/commit/d1658da9c8aa4377421430a32669e91b496bd8a8)
- Add TrieNode tree type. [`70f48a6`](https://github.com/loophp/phptree/commit/70f48a6c88bf50ac54353ab42a71fd1ef0fe7936)
- Improve performance. [`78731bb`](https://github.com/loophp/phptree/commit/78731bb903150f3b5a7e0d251a20ec5aab475c2e)
- Update documentation and code coverage. [`f2e0875`](https://github.com/loophp/phptree/commit/f2e0875ef83835914682de6756381ba8cfb13c78)
- Increase code coverage. [`c24713c`](https://github.com/loophp/phptree/commit/c24713caab3dae8016219daf228f45066764118a)

## [2.1.1](https://github.com/loophp/phptree/compare/2.1.0...2.1.1) - 2018-12-16

### Commits

- Update the Text importer and increase code coverage. [`e136a4d`](https://github.com/loophp/phptree/commit/e136a4d838734ab8bf20eb17eeccd38cc9d27769)
- Update README. [`b090550`](https://github.com/loophp/phptree/commit/b090550d19ac43461ac45e11dfc758ec90a15cce)
- Add an array importer and its tests. [`8a93bcd`](https://github.com/loophp/phptree/commit/8a93bcd4ee76934852fcda4a8e87b7f6dea05e33)

## [2.1.0](https://github.com/loophp/phptree/compare/2.0.0...2.1.0) - 2018-12-16

### Merged

- Implements a simple text converter and importer. [`#2`](https://github.com/loophp/phptree/pull/2)

### Commits

- Implement the Text importer. [`9b87679`](https://github.com/loophp/phptree/commit/9b87679b778049d10b56530597009d7c9fd963e7)
- Implement the Text exporter. [`da0d636`](https://github.com/loophp/phptree/commit/da0d63604cd2c5172c6a178fb7c80f526fbcb679)
- Move from Converter to Exporter wording. Sorry for the BC. [`1b1b02e`](https://github.com/loophp/phptree/commit/1b1b02eec3cea4f2ab485322639f1ec2265cb383)
- Update README for upcoming changes. [`67d2320`](https://github.com/loophp/phptree/commit/67d232078f4993b4acd9a8c718cbb053be098e07)
- Add benchmarks. [`e24960d`](https://github.com/loophp/phptree/commit/e24960d798bf6d87399cac54531ad61205deb085)
- Fix typos in README. [`afa6445`](https://github.com/loophp/phptree/commit/afa6445191763bd223bf659f46ec60c660e774a4)
- Update the ValueGraph object, it can be easily used when doing example trees. [`e7277f0`](https://github.com/loophp/phptree/commit/e7277f00869c2e9f957d47b77d3fcc2c38d056ab)

## [2.0.0](https://github.com/loophp/phptree/compare/1.1.0...2.0.0) - 2018-12-13

### Merged

- Prepare version 2 [`#1`](https://github.com/loophp/phptree/pull/1)

### Commits

- Update syntax. [`6476e4e`](https://github.com/loophp/phptree/commit/6476e4ee46a7d2af86a95f88a405aa542d4ca78b)
- Increase code coverage. [`d77e679`](https://github.com/loophp/phptree/commit/d77e6792514c9d13c31d7a177a4dcb4fef389645)

## [1.1.0](https://github.com/loophp/phptree/compare/1.0.0...1.1.0) - 2018-12-11

### Commits

- Increase code coverage. [`487454c`](https://github.com/loophp/phptree/commit/487454c445eb9d9890fa8edd49a44dc833591069)
- Update README file. [`238f4e6`](https://github.com/loophp/phptree/commit/238f4e6768b60bbd5c74c1283c74a427b0d77d53)
- Update the Graph converter and allow vertices to be updated. [`1d704b0`](https://github.com/loophp/phptree/commit/1d704b02744632fa25bf9ba3247a46ab552c7586)
- Update CS. [`8918038`](https://github.com/loophp/phptree/commit/89180389dfd6371085f6d9de8a8caff12fc794d3)
- Remove the Renderer and add the Converter. [`3057801`](https://github.com/loophp/phptree/commit/3057801ef2b4c91bc25b2d972a2ac3c959169c16)
- Use iterator_count(). [`66e1108`](https://github.com/loophp/phptree/commit/66e110812068efcda0e45ca726b70532af6bb724)
- Use Yield instead of regular foreach. [`cbc2219`](https://github.com/loophp/phptree/commit/cbc2219af3a89a5e00e406736696f42e45332649)
- Fix CS. [`a93cab3`](https://github.com/loophp/phptree/commit/a93cab3d4ad4c7deee18af7d58d6caa42d996d32)
- Add a new level parameter to the abstract visitor class and interface. [`697665c`](https://github.com/loophp/phptree/commit/697665cd49f618bbd8620d28b61bd271baefb3b1)
- Add a new level parameter to the PreOrder and PostOrder visitors. [`e848e8b`](https://github.com/loophp/phptree/commit/e848e8bba4f6c18fda0759ee3bfb392bae9d3e95)
- Add a new level parameter to the BreadthFirst visitor. [`5c924b9`](https://github.com/loophp/phptree/commit/5c924b94548cb367dda253a96f62af5213a02548)
- Add the depth() method. [`8f46d3c`](https://github.com/loophp/phptree/commit/8f46d3cb04929abd01f6b90143186b23cb0f41ae)
- Remove the display method and its test. [`72bb2ba`](https://github.com/loophp/phptree/commit/72bb2ba7534a84c8b3bd0f88f86e7d410ae72ab9)
- Increase code coverage. [`c563912`](https://github.com/loophp/phptree/commit/c563912e9e07c4502aa4d30658ad6f070d653d36)
- Increase code coverage. [`fcb8b98`](https://github.com/loophp/phptree/commit/fcb8b980a96619774469e4731b47b193c2c45a76)
- Update code syntax. [`6fafadb`](https://github.com/loophp/phptree/commit/6fafadb17eaa2c977675fb7bc79d3f45060569a5)
- Add new withChildren() method. [`9aedb95`](https://github.com/loophp/phptree/commit/9aedb954185825dafbbac5986109ce96aaaf0fb5)
- Update GraphViz renderer. [`4295b3d`](https://github.com/loophp/phptree/commit/4295b3dbf99af1c5b31a18cc798b274ccb5d2205)
- Add GraphViz renderer. [`0727216`](https://github.com/loophp/phptree/commit/07272167569322c34e56555834d2f19712805e00)
- Add NaryNode tree. [`fd67e47`](https://github.com/loophp/phptree/commit/fd67e47ca4d56b9fbc8f2865a77a6524a8075162)

## 1.0.0 - 2018-12-07

### Commits

- Update README. [`bc78ffb`](https://github.com/loophp/phptree/commit/bc78ffb5c6c13d01982b38c716b5159c41950db3)
- Update the PHPDoc. [`298d868`](https://github.com/loophp/phptree/commit/298d868c914edfa4a24a7030e2e91fb3b8b999b3)
- Implement the NodeInterface::remove() method. [`7420179`](https://github.com/loophp/phptree/commit/74201799ea101462233d0faf2a7ac15c1806c1bb)
- Update README. [`a94abdd`](https://github.com/loophp/phptree/commit/a94abdd9d441f4b241eecfd97fa92826279d9c04)
- Empty branch. [`1d42781`](https://github.com/loophp/phptree/commit/1d4278134c8c04a1f917881c7954032b1549d6d6)
- Initial commit. [`10cb361`](https://github.com/loophp/phptree/commit/10cb361f75e6e28d4b5e9b401bba997209a98f3e)
