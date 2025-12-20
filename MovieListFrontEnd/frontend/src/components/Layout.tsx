import React from 'react';
import { Link } from 'react-router-dom';

export default function Layout({ children }: { children: React.ReactNode }) {
  return (
    <div className="min-h-screen bg-gray-900 text-white">
      <header className="p-4 border-b border-gray-800">
        <div className="container mx-auto flex justify-between items-center">
          <Link to="/" className="text-xl font-bold">Movies App</Link>
        </div>
      </header>

      <main className="py-6">{children}</main>

      <footer className="p-4 border-t border-gray-800 text-center text-sm text-gray-400">
        &copy; {new Date().getFullYear()} Movies App
      </footer>
    </div>
  );
}

