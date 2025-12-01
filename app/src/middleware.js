import { NextResponse } from "next/server";

export function middleware(request) {
  const token = request.cookies.get("authToken")?.value;
  const { pathname } = request.nextUrl;

  if (token && pathname.startsWith("/login")) {
    return NextResponse.redirect(new URL("/home", request.url));
  }

  if (!token && pathname.startsWith("/home")) {
    return NextResponse.redirect(new URL("/login", request.url));
  }

  return NextResponse.next();
}

export const config = {
  matcher: ["/login", "/home/:path*"],
};
