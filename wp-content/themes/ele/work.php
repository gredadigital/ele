<?php
/*Template Name: Work */
get_header();
?>
<div class="card  mb-[600px] relative z-40">
    <div class="card card bg-light text-gray-900 relative z-40 lg:mb-[900px]  md:mb-[600px]  rounded-b-3xl flex flex-col gap-38 pt-[120px] pb-[100px]">
        <section class="hero px-[19px] py-[37px]">
            <h2 class="font-serif font-bold italic text-[22px] mb-[22px] text-center">Nuestro trabajo</h2>
            <p class="font-serif font-semibold text-[22px]/6 text-center">Universos mágicos con identidades y mensajes encantadores.
                Explora el trabajo que crea emociones fuertes y resultados tangibles.</p>
        </section>
        <section class="gal">
            <ul class="flex flex-col gap-[1px]">
                <li>
                    <a href=""><img class="w-full" src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png" alt=""></a>
                    <div class="txt hidden"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, ut.</p></div>
                </li>
                <li>
                    <a href=""><img class="w-full" src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png" alt=""></a>
                    <div class="txt hidden"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, ut.</p></div>
                </li>
                <li>
                    <a href=""><img class="w-full" src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png" alt=""></a>
                    <div class="txt hidden"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, ut.</p></div>
                </li>
                <li>
                    <a href=""><img class="w-full" src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png" alt=""></a>
                    <div class="txt hidden"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, ut.</p></div>
                </li>
            </ul>
                <button class="fixed z-[8888] bg-black flex justify-between bottom-[60px] left-[50%] -translate-x-[50%] w-[110px] pl-[12px] pr-[6px] py-[6px] rounded-full content-center"><span class="text-light text-[14px]/9">Filtros</span>
                <span class="block h-[39px] w-[39px] bg-[url('../images/plus.svg')] bg-no-repeat bg-center bg-contain"></span></button>
        </section>


    </div>

<section class="renovar px-[44px] py-[60px] text-light bg-black flex flex-col content-center">
    <p class="font-sans font-light text-[40px]/9 mb-[15px] text-center">¿Es momento de renovar tu marca?</p>
        <a href="" class="bg-secundario p-[6px] flex gap-[4px] w-[100ppx] rounded-full"><span>Averiguémoslo</span> <span class="block w-[20px] h-[20px] bg-[url('../images/flecha.svg')]"></span></a>
</section>

    <div class="cont bg-orange rounded-3xl px-[58px] py-[100px]">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png" alt="">
        <p>Somos un equipo pequeño pero poderoso</p>
        <div>
            <a href="" class="bg-black p-[6px] flex gap-[4px] w-[100ppx] rounded-full"><span class="text-light">Conócenos</span> <span class="block w-[20px] h-[20px] bg-[url('../images/flecha.svg')]"></span></a>
        </div>
    </div>
</div>



<?php
get_footer();
?>
