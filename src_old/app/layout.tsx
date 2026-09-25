import type { Metadata } from "next";
import { Inter } from "next/font/google";
import "./globals.css";
import TopBar from "@/components/TopBar";
import Header from "@/components/Header";
import Footer from "@/components/Footer";

const inter = Inter({
  variable: "--font-inter",
  subsets: ["latin"],
});

export const metadata: Metadata = {
  title: "Central Hospital Indore | Central Hospital Indore",
  description: "Central Hospital Indore (CHI) is a premier healthcare destination offering emergency care, advanced surgeries, and compassionate patient care in Indore.",
  keywords: "CHI, Hospital, Indore, Multispeciality, Healthcare, Emergency, Surgery, Cardiology",
  openGraph: {
    title: "Central Hospital Indore | Central Hospital Indore",
    description: "Premium healthcare destination in Indore. Compassionate patient care and advanced medical technology.",
    url: "https://www.centralhospitalindore.com/",
    siteName: "Central Hospital Indore",
    type: "website",
  }
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="en" className={`${inter.variable} h-full antialiased`}>
      <body className="min-h-full flex flex-col">
        <TopBar />
        <Header />
        <main className="flex-1">{children}</main>
        <Footer />
      </body>
    </html>
  );
}
