<style>
.message.error {
    background-color: #F2DEDE;
    border: 1px solid #ebccd1;
    color: #a94442;
    float: left;
    left: 0;
    margin: 0;
    padding: 10px;
    position: absolute;
    text-align: center;
    top: 0;
    width: 100%;
    z-index: 999;
}
</style>

<div class="message error" onclick="this.classList.add('hidden');"><?= h($message) ?></div>
<script type="text/javascript">
	$(document).ready(function() {
	$('.message').delay(4000).fadeOut(400);
});
</script>