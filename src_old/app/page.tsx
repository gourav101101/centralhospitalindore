import React from 'react';
import HeroSection from '@/components/HeroSection';
import QuickAccess from '@/components/QuickAccess';
import AboutSection from '@/components/AboutSection';
import DepartmentsSection from '@/components/DepartmentsSection';
import WhyChooseUs from '@/components/WhyChooseUs';
import DoctorsSection from '@/components/DoctorsSection';
import ServicesSection from '@/components/ServicesSection';
import TestimonialsSection from '@/components/TestimonialsSection';
import BlogSection from '@/components/BlogSection';
import AppointmentCTA from '@/components/AppointmentCTA';

export default function Home() {
  return (
    <>
      <HeroSection />
      <QuickAccess />
      <AboutSection />
      <DepartmentsSection />
      <WhyChooseUs />
      <DoctorsSection />
      <ServicesSection />
      <TestimonialsSection />
      <BlogSection />
      <AppointmentCTA />
    </>
  );
}
