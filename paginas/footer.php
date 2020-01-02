<footer>
		<div class="footer-mid">
			<div class="col-1 logo-kia">
				<img src="https://kiabrisa.com.br/wp-content/uploads/2016/07/logo-footer-2.png">
			</div>
		</div>
		<div class="footer-bottom">
			<div class="row  d-none d-md-block d-lg-block">
				<div class="col-4">
					<a href="https://kiabrisa.com.br/"><img src="https://kiabrisa.com.br/wp-content/uploads/2019/05/logo-kiabrisa-numero-1.png" class="img-fluid" alt="Kia Brisa | A maior e melhor concessionária Kia do Brasil"></a>
				</div>
				<div class="col">
					<p class="text-center">Av. Barão Homem de Melo, 3030 - Estoril, Belo Horizonte - MG</p>
					<p class="text-center"> <a href="tel:+553125194001"> <i class="fa fa-phone-alt"></i> (31) 2519-4001 </a> | <a href="https://api.whatsapp.com/send?phone=5531993589358&text=Ol%C3%A1%20tenho%20interesse%20no%20KIA..."><i class="fab fa-whatsapp"></i> (31) 99358-9358 </a></p>
				</div>
			</div>
			<div class="row  d-block d-sm-none">
				<div class="col-12">
					<a href="https://kiabrisa.com.br/"><img src="https://kiabrisa.com.br/wp-content/uploads/2019/05/logo-kiabrisa-numero-1.png" class="img-fluid" alt="Kia Brisa | A maior e melhor concessionária Kia do Brasil"></a>
				</div>
				<div class="col-12">
					<p class="text-center">Av. Barão Homem de Melo, 3030 - Estoril, Belo Horizonte - MG</p>
					<p class="text-center"> <a href="tel:+553125194001"> <i class="fa fa-phone-alt"></i> (31) 2519-4001 </a> | <a href="https://api.whatsapp.com/send?phone=5531993589358&text=Ol%C3%A1%20tenho%20interesse%20no%20KIA..."><i class="fab fa-whatsapp"></i> (31) 99358-9358 </a></p>
				</div>
			</div>
			
		</div>
	</footer>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script src="<?=URL::getBase()?>assets/js/bootstrap.min.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="<?=URL::getBase()?>assets/js/popper.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="https://kit.fontawesome.com/6c90086fc9.js" crossorigin="anonymous"></script>
	<script src="<?=URL::getBase()?>assets/js/jquery.mask.min.js" type="text/javascript" charset="utf-8" async defer></script>
	<script type="text/javascript">
		$(document).ready(function(){
		  var SPMaskBehavior = function (val) {
		    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
		  },
		  spOptions = {
		    onKeyPress: function(val, e, field, options) {
		        field.mask(SPMaskBehavior.apply({}, arguments), options);
		      }
		  };

		  $('.phone').mask(SPMaskBehavior, spOptions);
		});
		
	</script>
	<script>
		fbq('track', 'Lead');
	</script>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NW3QF2F');</script>
	<!-- End Google Tag Manager -->
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NW3QF2F"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	</body>
</html>