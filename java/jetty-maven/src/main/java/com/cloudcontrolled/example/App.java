package com.cloudcontrolled.example;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.http.*;

import org.eclipse.jetty.server.Server;
import org.eclipse.jetty.servlet.*;

/**
* Java WEB application with embedded Jetty server
*
*/
public class App extends HttpServlet
{

    private static final long serialVersionUID = -96650638989718048L;

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException
    {
        System.out.println("Request received from: "+req.getLocalAddr());
        resp.setContentType("text/html");
        PrintWriter out = resp.getWriter();
        out.println("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">");
        out.println("<HTML>");
        out.println(" <HEAD><TITLE>Java WEB/Jetty example</TITLE></HEAD>");
        out.println(" <BODY>");
        out.print("<center>");
        out.print(" This is Java WEB application with embedded Jetty server deployed in cloudControl platform");
        out.print("</center>");
        out.println(" </BODY>");
        out.println("</HTML>");
        out.flush();
        out.close();
    }

    public static void main(String[] args) throws Exception
    {
        Server server = new Server(Integer.valueOf(System.getenv("PORT")));
        ServletContextHandler context = new ServletContextHandler(ServletContextHandler.SESSIONS);
        context.setContextPath("/");
        server.setHandler(context);
        context.addServlet(new ServletHolder(new App()),"/*");
        server.start();
        server.join();
        System.out.println("Application started");
    }
}