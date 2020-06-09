<template>
	<div>
  <!--==========================
  Header
  ============================-->
  <Header />

  <!--==========================
    Hero Section
  ============================-->
  <Hero />
  <!-- #hero -->

  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <About />
	<!-- #about -->

    <!--==========================
      Facts Section
    ============================-->
    <Fact />
    <!-- #facts -->

    <!--==========================
      Services Section
    ============================-->
    <Service />
    <!-- #services -->

    <!--==========================
    Call To Action Section
    ============================-->
    <Action />
    <!-- #call-to-action -->

    <!--==========================
      Portfolio Section
    ============================-->
    <Portfolio />
   <!-- #portfolio -->

    <!--==========================
      Team Section
    ============================-->
    <Team />
    <!-- #team -->

    <!--==========================
      Contact Section
    ============================-->
    <Contact />
<!-- #contact -->

  </main>

  <!--==========================
    Footer
  ============================-->
  <Footer /><!-- #footer -->

 <Icon />
</div>
</template>

<script>

import Header from '@/components/Header.vue'
import Hero from '@/components/Hero.vue'
import About from '@/components/About.vue'
import Fact from '@/components/Fact.vue'
import Service from '@/components/Service.vue'
import Action from '@/components/Action.vue'
import Portfolio from '@/components/Portfolio.vue'
import Team from '@/components/Team.vue'
import Contact from '@/components/Contact.vue'
import Footer from '@/components/Footer.vue'
import Icon from '@/components/Icon.vue'


export default {
  name: 'Home',
 components: {
    Header,
    Hero,
    About,
    Fact,
    Service,
    Action,
    Portfolio,
    Team,
    Contact,
    Footer,
    Icon
  },
}
</script>