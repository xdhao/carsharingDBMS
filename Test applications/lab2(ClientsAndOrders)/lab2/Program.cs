using System;
using Oracle.ManagedDataAccess.Client;

namespace lab2
{
    class Program
    {
        
        static void Main(string[] args)
        {
            Irepository myRep = new OracleRepository();
            //string obj = myRep.CalculationOfCost(new Clients(4, "", "", "", "", "", "", "", 0, 0));
            //Console.WriteLine(obj);
            //myRep.AddReviews(new Reviews(1, "привет5", 2.5f, "awda241", 4));
            //myRep.UpdateReviews(new Reviews(24, "65 баллов", 5.0f, "QEST21521", 6));
            //myRep.DeleteReviews(new Reviews(41, "", 0, "", 0));
            var reviews = myRep.GetReviews();
            /*foreach(var review in reviews)
            {
                Console.WriteLine(review);
            }*/
            /*var raitingClients = myRep.GetRatingOutput();
            foreach(var raitingClient in raitingClients)
            {
                Console.WriteLine(raitingClient);
            }*/
            string percent = myRep.PercentToRaiting(new Clients(0, "", "", "", "", "", "", "", 4.5, 0));
            Console.WriteLine(percent);
        }
    }
}
