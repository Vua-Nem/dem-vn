@extends('layouts.master')
@section('content')
<div class="policies">
	<div class="container">
		<h3 class="title-pages text-center">Chính sách</h3>
		<div class="w3-bar w3-black">
			<div class="tabs-items">
			  <button class="w3-bar-item w3-button active w3-button1" onclick="openCity('page_1')" data1="#cs1">Chương trình ngủ thử 180 đêm</button>
			</div>
			<div class="tabs-items">
			  <button class="w3-bar-item w3-button w3-button2" onclick="openCity('page_2')" data2="#cs2">Điều khoản & Điều kiện</button>
			</div>
			<div class="tabs-items">
			  <button class="w3-bar-item w3-button w3-button3" onclick="openCity('page_3')" data3="#cs3">Phương thức thanh toán</button>
			</div>
			<div class="tabs-items">
			  <button class="w3-bar-item w3-button w3-button4" onclick="openCity('page_4')" data4="#cs4">Chính sách vận chuyển <br>& giao nhận</button>
			</div>
			<div class="tabs-items">
			  <button class="w3-bar-item w3-button w3-button5" onclick="openCity('page_5')" data5="#cs5">Chính sách bảo hành</button>
			</div>
			<div class="tabs-items">
			  <button class="w3-bar-item w3-button w3-button6" onclick="openCity('page_6')" data6="#cs6">Chính sách bảo mật</button>
			</div>
		</div>

		<div id="page_1" class="w3-container page-items active w3-button1" name="#cs1">
			<h3 class="title-pages">Chương trình ngủ thử 180 đêm</h3>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo1">Đối tượng áp dụng</button>
			  <div id="demo1" class="collapse">
			    <p>Chính sách 180 đêm ngủ thử miễn phí tại Dem.vn được áp dụng cho các Quý khách hàng mua 01 trong 03 dòng sản phẩm sau:</p>
			    <div class="row">
			    	<div class="col-md-4 text-center">
			    		<a href="/products/dem_foam_gap_3_goodnight_eva.html">
				    		<img src="{{url("web/image/demeva.jpg")}}">
				    	</a>
			    		<p></p>
			    		<p>Đệm Foam Goodnight Eva</p>
			    	</div>
			    	<div class="col-md-4 text-center">
			    		<a href="/products/dem_foam_goodnight_galaxy.html">
				    		<img src="{{url("web/image/demgalaxy.jpg")}}">
				    	</a>
			    		<p></p><p>Đệm Foam Goodnight Galaxy</p>
			    	</div>
			    	<div class="col-md-4 text-center">
			    		<a href="/products/dem_lo_xo_goodnight_4stars.html">
			    		<img src="{{url("web/image/demstar.jpg")}}">
			    		</a>
			    		<p></p><p>Đệm Foam Goodnight 4stars</p>
			    	</div>
			    </div>
			  </div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo2">Chính sách 180 đêm ngủ thử miễn phí là gì?</button>
			  <div id="demo2" class="collapse">
			  	<p>
			  		Trong 180 đêm đầu tiên kể từ ngày nhận được đệm, Dem.vn khuyến khích Quý khách trải nghiệm nằm thử sản phẩm ít nhất 15 ngày. Quý khách hãy tận hưởng giấc ngủ trên chiếc đệm mới và cảm nhận sản phẩm có thực sự phù hợp với cơ thể của mình hay không. Đồng thời, để đảm bảo chất lượng sản phẩm, Quý khách nên sử dụng bảo vệ đệm, chăn ga phủ/bọc để sản phẩm đệm luôn trong tình trạng tốt nhất.</p>

				<p>Trong thời gian áp dụng chính sách 180 đêm ngủ thử, nếu Quý khách cảm thấy không hài lòng với sản phẩm đệm về bất cứ lý do gì, Quý khách hãy liên hệ với bộ phận Chăm sóc khách hàng (CSKH) của Dem.vn. Chúng tôi sẽ hỗ trợ Quý khách hoàn toàn miễn phí::</p>

				<p>Đổi sang một tấm đệm khác phù hợp hơn.<br>
				Hoặc trả lại hàng đã sử dụng và nhận lại toàn bộ số tiền đã thanh toán. 
				</p>
			  </div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo3">Điều kiện áp dụng chính sách</button>
			  <div id="demo3" class="collapse">
			  	Chính sách ngủ thử miễn phí 180 đêm chỉ áp dụng cho 01 sản phẩm đầu tiên trong cùng dòng sản phẩm tại một địa chỉ Dem.vn giao hàng.<br>
				Chính sách này chỉ áp dụng cho Quý khách mua hàng qua website Dem.vn hoặc Tổng đài 18002095.<br>
				Quý khách là người mua ban đầu và chủ sở hữu hiện tại của sản phẩm đệm. Quý khách vui lòng lưu giữ Đơn đặt hàng hoặc Hóa đơn VAT để xuất trình nếu cần thiết.<br>
				Sản phẩm được đổi/trả phải ở trong tình trạng như ban đầu và không bị hư hại bởi tác động bên ngoài.<br>
				Sản phẩm đệm kích thước chuẩn (*) là các kích cỡ 120*200, 160*200, 180*200, 200*220
			  </div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo4">Cách thức đổi/ trả sản phẩm</button>
			  <div id="demo4" class="collapse">
			  	<p>Quý khách vui lòng liên hệ Bộ phận CSKH Dem.vn để được tư vấn chi tiết.</p>
				<p>
					<strong>Hotline:</strong> 18002095 – nhánh 2<br>
					<strong>Email:</strong> cskh@dem.vn
				</p>
				<p>
					Nhân viên CSKH của Dem.vn sẽ kiểm tra và phản hồi thông tin tới Quý khách liên quan đến sản phẩm đệm đổi/trả.
				</p>
				<p>
					Dem.vn sẽ hoàn tiền vào số tài khoản mà khách hàng cung cấp trong vòng 05 ngày làm việc kể từ ngày Dem.vn nhận lại được sản phẩm (trừ trường hợp Quý khách mua hàng trả góp).
				</p>
			  </div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo5">Các trường hợp từ chối đổi/trả sản phẩm</button>
			  <div id="demo5" class="collapse">
			  	<p>Các sản phẩm đệm với kích cỡ đặc biệt (không phải kích thước chuẩn (*)) theo yêu cầu đặt riêng của Quý khách sẽ không được áp dụng chính sách ngủ thử 180 đêm miễn phí.

				</p>
				<p>
					Chương trình ngủ thử 180 đêm không áp dụng đổi sang kích thước mới trong cùng một dòng sản phẩm.
				</p>
			  </div>
			</div>
		</div>
		<div id="page_2" class="w3-container page-items w3-button2" name="#cs2">
		 	<h3 class="title-pages">Điều khoản & điều kiện</h3>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo21">Điều khoản sử dụng chung</button>
			  <div id="demo21" class="collapse">
			    <p>Những điều khoản sử dụng này quy định việc sử dụng của bạn đối với website mang tiên miền Dem.vn thuộc quyền khai thác của Công ty Cổ Phần Vua Nệm. Việc bạn sử dụng website này đồng nghĩa với việc chấp thuận những các điều khoản, điều kiện ghi nhận tại đây.</p>
			  </div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo22">Hạn chế sử dụng chung, quyền sở hữu trí tuệ</button>
			  <div id="demo22" class="collapse">
			    <p>Tất cả các nội dung thể hiện tại đây, bao gồm nhưng không giới hạn các thông tin, tài liệu, sản phẩm, hình ảnh, bố trí (sau đây gọi chung là “Tài Liệu”) thuộc quyền sở hữu trí tuệ và/hoặc quyền khai thác sử dụng của Dem.vn đối với quyền tác giả, nhãn hiệu hàng hoá, sáng chế, kiểu dáng công nghiệp và các quyền khác theo quy định pháp luật.</p>

				<p>Bạn được sử dụng các Tài Liệu đăng tải trên website này cho mục đích tiêu dùng cá nhân, không vì mục đích thương mại và không được sử dụng cho bất kỳ mục đích nào khác ngoài mục đích phi thương mại. Việc sao chép, sửa đổi một phần hay toàn bộ, truyền tải, phân phối, nhượng lại quyền, bán hay xuất bản bất cứ tài nguyên nào đều bị cấm nếu không được sự chấp thuận trước bằng văn bản thành viên liên quan của Dem.vn. Trích dẫn nguồn từ website này là yêu cầu bắt buộc khi sử dụng bất cứ Tài liệu nào của chúng tôi.</p>
			  </div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo23">Sự từ chối chung</button>
			  <div id="demo23" class="collapse">
			    <p>Các dịch vụ và tài liệu được dự kiến chỉ dành cho khách hàng của Dem.vn và được cung cấp chỉ cho sự thuận tiện của các đối tượng truy cập website này. Dem.vn không cấp quyền sở hữu cho bất kỳ bên thứ ba nào liên quan đến quyền sở hữu trí tuệ nào ngoài mục đích hỗ trợ các bạn thực hiện các quyền trên của bạn. Độ tin cậy vào thông tin, tài liệu, độ chính xác tại đây rất cao. Tuy nhiên, Dem.vn bảo lưu quyền và không chịu trách nhiệm đảm bảo độ chính xác, tính đầy đủ, hay độ tin cậy của các thông tin, dịch vụ, tài liệu và các khoản mục khác chứa đựng được cung cấp qua website này dưới mọi hình thức.
				</p>
			  </div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo24">Giới hạn trách nhiệm pháp lý</button>
			  <div id="demo24" class="collapse">
			    <p>Dem.vn sẽ không chịu bất cứ thiệt hại hay trách nhiệm nào phát sinh do việc sử dụng hay không thể sử dụng website của chúng tôi. Giới hạn trách nhiệm này bao gồm, nhưng không giới hạn bởi việc truyền tải virus có thể lây nhiễm vào thiết bị của bạn, thiết bị điện tử hoặc đường dây thông tin liên lạc, điện thoại bị hư hỏng hay các sự cố kết nối khác không có khả năng truy cập internet của quý vị, việc truy cập trái phép, lỗi hệ điều hành hay bất kỳ rủi ro nào khác. Chúng tôi sẽ không chịu trách nhiệm đối với bất kỳ hành động hay thiệt hại nào phát sinh liên quan đến giới hạn trách nhiệm trên. Chúng tôi cũng không chịu bất cứ nghĩa vụ pháp lý nào đối với các thông tin, tài liệu được đăng tải cho dù được cung cấp bởi Dem.vn hoặc bất kỳ bên thứ ba nào khác.
				</p>
				<P></P>
				<P><I>Được cập nhật lần cuối vào tháng 02/2021</I></P>
			  </div>
			</div>
		</div>
		<div id="page_3" class="w3-container page-items w3-button3" name="#cs3">
		 <h3 class="title-pages">Phương thức thanh toán tại Dem.vn</h3>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo31">Thanh toán bằng tiền mặt</button>
			  <div id="demo31" class="collapse">
			    <p>COD: Hình thức giao hàng thu tiền. Khi chúng tôi giao hàng đến địa chỉ của Khách hàng, chúng tôi sẽ thu tiền theo đơn hàng Khách hàng đã đặt</p>
			  </div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo32">Thanh toán bằng chuyển khoản</button>
			  <div id="demo32" class="collapse">
			    <p>Quý khách có thể thực hiện thanh toán bằng phương thức chuyển khoản qua ngân hàng cho chúng tôi vào một trong các tài khoản sau đây:</p>
			    <div class="bank-items row" style="padding-top: 15px;">
			    	<div class="col-md-6">
			    		<div class="bank-items-1 ">
				    		<img src="{{url("web/image/bank-vietcombank.png")}}">
				    		 <p style="padding-bottom: 10px;"></p>
				    		<p>Tài khoản Ngân hàng TMCP Ngoại thương Việt Nam (Vietcombank):</p>
							<p>– Số tài khoản: 0971.0000.15217</p>
							<p>– Chủ tài khoản: Công ty cổ phần Vua Nệm</p>
							<p>– Ngân hàng TMCP Ngoại thương Việt Nam (Vietcombank) – Chi nhánh Nam Hà Nội</p>
						</div>
			    	</div>
			    	<div class="col-md-6">
			    		<div class="bank-items-1 ">
				    		<img src="{{url("web/image/bank-biv.png")}}">
				    		 <p style="padding-bottom: 10px;"></p>
				    		<p>Ngân hàng TMCP Đầu tư và Phát triển Việt Nam (BIDV)</p>
							<p>– Số tài khoản: 21610000601982</p>
							<p>– Chủ tài khoản: Công ty cổ phần Vua Nệm</p>
							<p>– Ngân hàng TMCP Đầu tư và Phát triển Việt Nam (BIDV) – Chi nhánh Đống Đa Hà Nội,</p>
						</div>
			    	</div>
			    </div>
			    <p style="padding-bottom: 30px;"></p>
			    <p>Sau khi thực hiện chuyển khoản thanh toán, quý khách hàng vui lòng báo cho bộ phận bán hàng để xác nhận một cách nhanh nhất. Ngay sau khi nhận được thanh toán, Dem.vn/Vua Nệm sẽ tiến hành hoàn tất thủ tục đặt hàng và giao hàng trong thời gian quy định. Đơn hàng sẽ không được thực hiện nếu Quý khách chưa thanh toán.</p>
				<p>Quý khách chỉ thanh toán khi thật sự hài lòng với sản phẩm và chất lượng dịch vụ của chúng tôi. Chúng tôi sẽ không tính bất kỳ khoản phí nào cho đến khi Quý khách hoàn toàn đồng ý.</p>
				<p>Để được tư vấn và giải đáp thắc mắc, Quý khách vui lòng liên hệ email: cskh@dem.vn hoặc Hotline 1800 2095 (miễn phí cước).</p>
				<p>Lưu ý: Ngay sau khi nhận được tiền thanh toán, Dem.vn/Vuanem sẽ liên hệ với quý khách về thời gian và Phương tiện chuyển hàng.</p>
			  </div>
			</div>
		</div>
		<div id="page_4" class="w3-container page-items w3-button4" name="#cs4">
		 	<h3 class="title-pages">Chính sách giao hàng tại Dem.vn</h3>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo41">Khung thời gian giao hàng</button>
			  	<div id="demo41" class="collapse">
				    <p>
				    	Khu vực 1: Các thành phố gồm Hà Nội, Hồ Chí Minh, Đà Nẵng, Vũng Tàu, Bình Dương, Đồng Nai, Thanh Hóa, Hải Phòng, Kiên Giang, Cần Thơ, An Giang, Đồng Tháp, Bạc Liêu.
				    </p>
				    <div class="row">
				    	<div class="col-md-6">
							<strong>Khung thời gian đặt hàng</strong><br>
							Từ 8h30 đến trước 12h<br>
							Từ 12h đến trước 17h<br>
							Từ 17h ngày D đến trước 8h30 ngày D + 1
						</div>
						<div class="col-md-6">
							<strong>Khung thời gian nhận được hàng</strong><br>
							Từ 12h trong ngày<br>
							Từ 15h trong ngày<br>
							Trước 12h ngày D + 1
						</div>
						<p></p>
						<p>Đối với các địa chỉ từ 30km trở ra tính từ trung tâm thành phố, đơn hàng của Quý khách sẽ được giao sau 02 ngày.</p>
						<p><strong>Khu vực 2:</strong> Các thành phố còn lại</p>
						<p>Đối với các địa chỉ giao hàng tại các thành phố khác, đơn hàng của Quý khách sẽ được sau 03 – 05 ngày</p>
				  </div>
				</div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo42">Lưu ý khác</button>
			  <div id="demo42" class="collapse">
			  	<p>a. Việc giao hàng được thực hiện tất cả các ngày trong tuần, trừ ngày Lễ, Tết.</p>
				<p>b. Giao hàng miễn phí không áp dụng đối với các mặt hàng nằm trong các chương trình xả hàng, thanh lý (có mức giảm giá, chiết khấu quá 50% giá niêm yết).</p>
				<p>c. Thời gian giao nhận hàng trên áp dụng đối với đơn hàng trong 30 km và các mặt hàng có sẵn. Với các đơn hàng ngoài 30 km hoặc mặt hàng không có sẵn, nhân viên bán hàng của chúng tôi sẽ trao đổi cụ thể về thời gian giao nhận hàng với Quý Khách hàng trong quá trình hoàn tất thủ tục đặt hàng.</p>
				<p>e. Hàng hóa được giao bởi Dem.vn luôn đi kèm với hóa đơn bán hàng. Trên hóa đơn luôn ghi rõ: Địa chỉ, số điện thoại và thông tin cá nhân của Khách Hàng và các thông tin của chúng tôi. Quý Khách vui lòng kiểm tra kỹ hàng hóa, thông tin trên hóa đơn bán hàng và ký nhận hàng trên hóa đơn.</p>
			  </div>
			</div>
		</div>
		<div id="page_5" class="w3-container page-items w3-button5" name="#cs5">
			<h3 class="title-pages">Chính sách bảo hành sản phẩm tại Dem.vn</h3>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo51">Đối tượng được tham gia chương trình bảo hành</button>
			  <div id="demo51" class="collapse">
			  	<p>Quý khách mua hàng qua website Dem.vn hoặc Tổng đài 18002095. </p>
			  </div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo52">Điều kiện bảo hành</button>
			  <div id="demo52" class="collapse">
			  	<p><strong>Đệm được bảo hành miễn phí nếu đảm bảo tất cả các điều kiện sau:</strong></p>
				<p>+ Đệm lún vượt quá “ độ lún tự nhiên” hay được hiểu là độ lún vượt quá 10% độ dày của đệm. </p>
				<p>+ Đệm bị lỗi kỹ thuật do Nhà sản xuất (Độ dày cứng của các tấm đệm không bằng nhau, mặt cắt không phẳng, bề mặt sản phẩm bị lồi lõm, lỗi liên quan đến phần lõi, chỉ viền xung quanh…).</p>
				<p>+ Thời hạn bảo hành trên phiếu bảo hành, hoặc hệ thống bảo hành điện tử vẫn còn hiệu lực.</p>
				<p><strong>Điều kiện không được bảo hành hoặc sẽ phát sinh phí bảo hành nếu thuộc trong các trường hợp sau:</strong></p>
				<p>+ Đệm hết thời hạn bảo hành. </p>
				<p>+ Đệm có các lỗi vệ sinh: lỗi bẩn, rách do tác động ngoại cảnh hoặc đổi màu theo thời gian.</p>
				<p>+ Đệm có độ lún tự nhiên. </p>
				<p>+ Đệm có mùi vải hoặc mùi foam tự nhiên. </p>
				<p>+ Đệm bị ẩm hoặc mốc do việc sử dụng không đúng quy cách. </p>
				<p>+ Đệm bị cháy do bất cẩn trong quá trình sử dụng.  </p>
				<p>+ Đệm được đặt trên dát giường không phẳng. </p>
				<p>+ Đệm được đặt trực tiếp dưới đất, đặt đệm ở nơi ánh nắng chiếu trực tiếp hoặc điều kiện môi trường gây ẩm mốc. </p>
				<p>+ Sử dụng sai chức năng của đệm. </p>
				<p>+ Đệm không thỏa mãn một trong các điều kiện ở mục 2.1</p>
			  </div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo53">Đối tượng được tham gia chương trình bảo hành</button>
			  <div id="demo53" class="collapse">
			  	<p><strong>Thông tin liên hệ:</strong></p> 
				<p>Quý khách vui lòng liên hệ Bộ phận Chăm sóc khách hàng Dem.vn để được hỗ trợ và tư vấn chi tiết.</p> 
				<p>Hotline 18002095 – nhánh 2</p> 
				<p>Email: cskh@dem.vn</p> 
				<p><strong>Thời hạn bảo hành:</strong></p> 
				<p>Thời hạn bảo hành được tính kể từ ngày Quý khách nhận hàng.</p> 
				<p>Quy trình thực hiện bảo hành:</strong></p> 
				<p>Trong mọi trường hợp, thời gian thực hiện bảo hành đệm phụ thuộc vào chính sách và/hoặc mức độ sẵn có của sản phẩm đệm thay thế của Nhà sản xuất và sẽ được thông báo cụ thể cho Quý khách vào thời điểm Nhà sản xuất nhận sản phẩm. </p> 
				<p><strong>Quy trình thực hiện bảo hành như sau: </strong></p> 
				<p>Giai đoạn 1: Nhân viên kỹ thuật của Dem.vn kiểm tra sản phẩm trực tiếp tại nhà Quý khách và ghi nhận lỗi thực tế.<br>
				Giai đoạn 2: Nhân viên vận chuyển Dem.vn thu hồi đệm và tiến hành gửi bảo hành sản phẩm đệm cho Nhà sản xuất<br>
				Giai đoạn 3: Nhân viên vận chuyển Dem.vn hoàn trả lại sản phẩm cho Quý khách sau khi Nhà sản xuất bảo hành sản phẩm.<br>
				Trong thời gian bảo hành sản phẩm đệm, Quý khách có thể mượn đệm cùng loại hoặc khác loại sử dụng thay thế phụ thuộc mức độ sẵn có sản phẩm đệm của Dem.vn.</p> 
			  </div>
			</div>
		</div>
		<div id="page_6" class="w3-container page-items w3-button6" name="#cs6">
		 	<h3 class="title-pages">Chương trình ngủ thử 180 đêm</h3>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo61">Mục đích và phạm vi thu thập</button>
			  <div id="demo61" class="collapse">
			  	<p>Để truy cập và sử dụng một số dịch vụ tại website của Dem.vn, bạn có thể sẽ được yêu cầu đăng ký với chúng tôi thông tin cá nhân (Họ tên, Số điện thoại liên hệ, Giới tính, Email, Địa chỉ…). Mọi thông tin bạn cung cấp phải đảm bảo tính chính xác và hợp pháp. Chúng tôi sẽ không chịu mọi trách nhiệm liên quan đến pháp luật về thông tin khai báo của bạn.  Website chỉ sử dụng các thông tin này để hỗ trợ bạn trong quá trình mua hàng và giao hàng.</p>
				<p>Ngoài ra, khi bạn sử dụng dịch vụ hoặc xem nội dung do chúng tôi cung cấp tại website, chúng tôi tự động thu thập và lưu trữ một số thông tin trong nhật ký máy chủ. Những thông tin này bao gồm:<br>
				–  Các chi tiết về cách bạn sử dụng dịch vụ của website, chẳng hạn như truy vấn tìm kiếm.<br>
				–  Địa chỉ giao thức Internet.<br>
				–  Thông tin sự cố thiết bị như lỗi, hoạt động của hệ thống, cài đặt phần cứng, loại trình duyệt, ngôn ngữ trình duyệt, ngày và thời gian bạn yêu cầu và URL giới thiệu.<br>
				–  Cookie có thể nhận dạng duy nhất trình duyệt hoặc Tài khoản của khách hàng</p>

				<p>Bạn có trách nhiệm thông báo kịp thời cho website về những hành vi sử dụng trái phép, lạm dụng, vi phạm bảo mật của bên thứ ba để có biện pháp giải quyết phù hợp. </p>
			  </div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo62">Các thông tin thu thập thông qua website sẽ giúp chúng tôi</button>
			  <div id="demo62" class="collapse">
			  	<p>–  Hỗ trợ bạn khi mua sản phẩm.<br>
				–  Tư vấn, giải đáp các thắc mắc của bạn<br>
				–  Khi cần thiết, chúng tôi có thể sử dụng những thông tin này để liên hệ trực tiếp với bạn dưới các hình thức như: gởi thư ngỏ, đơn đặt hàng, thư cảm ơn, thông tin về các chương trình khuyến mãi và sản phẩm mới …..<br>
				–  Liên lạc và giải quyết với bạn trong những trường hợp đặc biệt.<br>
				–  Không sử dụng thông tin cá nhân của bạn ngoài mục đích xác nhận và liên hệ có liên quan đến giao dịch với công ty chúng tôi<br>
				–  Trong trường hợp có yêu cầu của pháp luật: Chúng tôi có trách nhiệm hợp tác cung cấp thông tin cá nhân của bạn khi có yêu cầu từ cơ quan tư pháp bao gồm: Viện kiểm sát, tòa án, cơ quan công an điều tra liên quan đến hành vi vi phạm pháp luật nào đó của bạn. Ngoài ra, không ai có quyền xâm phạm vào thông tin cá nhân của bạn.</p>
			  </div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo63">Thời gian lưu trữ thông tin</button>
			   <div id="demo63" class="collapse">
			  	<p>–  Ngoại trừ các trường hợp về sử dụng thông tin cá nhân như đã nêu trong chính sách này, chúng tôi cam kết sẽ không tiết lộ thông tin cá nhân của bạn ra ngoài.<br>
				–  Thông tin cá nhân của bạn sẽ được chúng tôi lưu trữ cho đến khi có yêu cầu hủy bỏ.</p>
			   </div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo64">Địa chỉ của đơn vị thu thập và quản lý thông tin cá nhân</button>
			   <div id="demo64" class="collapse">
			  	<p>CÔNG TY CỔ PHẦN VUA NỆM<br>
					Số điện thoại: 1800 2095<br>
					Email: cskh@dem.vn<br>
					Địa chỉ VPĐD: Tầng 2, Tòa nhà Ocean Park, Số 1 Đào Duy Anh, Đống Đa, Hà Nội</p>
			   </div>
			</div>
			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo65">Phương tiện và công cụ để người dùng tiếp cận và chỉnh sửa dữ liệu cá nhân của mình.</button>
			   <div id="demo65" class="collapse">
			  	<p>Tại bất kỳ thời điểm nào bạn cũng có thể truy cập và chỉnh sửa những thông tin cá nhân của mình theo các liên kết thích hợp trên website mà chúng tôi cung cấp hoặc liên hệ tới chúng tôi để được cập nhật thay đổi.</p>
				<p>Bạn có quyền gửi khiếu nại đến website liên quan tới việc cam kết bảo mật thông tin cá nhân. Khi tiếp nhận những phản hồi này, chúng tôi sẽ xác nhận lại thông tin, trường hợp đúng như phản ánh của bạn, tùy theo mức độ chúng tôi sẽ có những biện pháp xử lý kịp thời.</p>
			   </div>
			</div>

			<div class="collapse-items">
			   <button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#demo66">Cam kết bảo mật thông tin cá nhân khách hàng</button>
			   <div id="demo66" class="collapse">
			  	<p>–  Thông tin cá nhân của bạn trên website được cam kết bảo mật tuyệt đối theo chính sách bảo vệ thông tin cá nhân của website. Việc thu thập và sử dụng thông tin của bạn chỉ được thực hiện khi có sự đồng ý của bạn đó trừ những trường hợp pháp luật có quy định khác.<br>
				–  Chúng tôi cam kết không bán, thuê lại hoặc cho thuê email của bạn từ bên thứ ba. Nếu bạn vô tình nhận được Email không theo yêu cầu từ hệ thống chúng tôi do một nguyên nhân ngoài ý muốn, xin vui lòng nhấn vào link từ chối nhận Email này kèm theo, hoặc thông báo trực tiếp đến ban quản trị Website.<br>
				–  Chúng tôi sẽ sử dụng nhiều công nghệ bảo mật thông tin khác nhau nhằm bảo vệ thông tin này không bị truy lục, sử dụng hoặc tiết lộ ngoài ý muốn. Trong trường hợp máy chủ lưu trữ thông tin bị hacker tấn công dẫn đến mất mát dữ liệu cá nhân khách hàng, chúng tôi sẽ có trách nhiệm thông báo vụ việc cho cơ quan chức năng điều tra xử lý kịp thời và thông báo cho bạn được biết.<br>
				–  Chúng tôi đề nghị bạn khi mua hàng phải cung cấp đầy đủ thông tin cá nhân có liên quan như: Họ và tên, địa chỉ liên lạc, điện thoại, …. và chịu trách nhiệm về những thông tin trên. Chúng tôi không chịu trách nhiệm cũng như không giải quyết mọi khiếu nại có liên quan đến quyền lợi của bạn nếu xét thấy tất cả thông tin cá nhân của bạn cung cấp khi liên hệ ban đầu là không chính xác.</p>
				<p>
				Chúng tôi luôn hoan nghênh các ý kiến đóng góp, liên hệ và phản hồi thông tin từ  bạn về “Chính sách bảo mật” này. Nếu bạn có những thắc mắc liên quan xin vui lòng liên hệ theo địa chỉ email: cskh@dem.vn
				</p>
			   </div>
			</div>
		</div>
	</div>
</div>
 
<script type="text/javascript" src="{{url("web/js/jquery.min.js")}}"></script>
<style type="text/css">
	.bank-items-1 {padding: 30px;box-shadow: 0px 4px 11px 2px rgba(0, 0, 0, 0.09);border-radius: 12px;    height: 100%;}
	.active.page-items{display: block!important;padding-bottom: 30px;}
	.page-items{display: none!important;}
	.collapse {padding: 0px 0 5px;}
	.collapse-items{font-size: 16px;color: #2F2F2F}
	.text-center{text-align: center;}
	.tabs-items{  width: 33.3%;padding:0 15px;    margin-bottom: 30px;}
	.w3-bar{display: flex;flex-wrap: wrap;}
	.w3-button.active{background: linear-gradient(90deg, #6C3DCE 0%, #BA87FC 100%);
		box-shadow: 0px 0px 11px 4px rgba(0, 0, 0, 0.05);color: #fff;font-size: 20px;
	}
	.w3-button{
		font-size: 20px;
		background: #FFFFFF; height: 145px; outline: none!important;    width: 100%;
		box-shadow: 0px 0px 11px 4px rgba(0, 0, 0, 0.05);    padding: 0 15px;
		border-radius: 12px;    border: none;
	}
	.title-pages{font-size: 30px;color: #410077;padding-top: 50px}
	.collapse-items{padding: 5px 0;border-top:1px solid #eaeaea;}
	.collapse-items button.btn{border:none;background: none;color: #410077;  padding-top: 13px;padding-bottom: 13px;   padding-right: 35px;position: relative;   text-align: left;    width: 100%;font-size: 20px;padding-left: 0;outline: none!important;box-shadow: none!important}
	.collapse-items button.btn.collapsed:before{content: "+";float: right;    font-weight: 600;font-size: 25px;line-height: normal;}
	.collapse-items button.btn:before{content: "-";float: right;  position: absolute;right: 15px;  font-weight: 600;font-size: 25px;line-height: normal;}

</style>
@endsection
<script type="text/javascript">
	function openCity(cityName) {
	  var x = document.getElementsByClassName("page-items");
	  for (i = 0; i < x.length; i++) {
	    x[i].style.display = "none";  

	  x[i].classList.remove("active");
	  }
	  document.getElementById(cityName).classList.add("active");
	  document.getElementById(cityName).style.display = "block";  
	};
</script>