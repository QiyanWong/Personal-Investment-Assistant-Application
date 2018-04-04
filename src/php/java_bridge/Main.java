

import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVRecord;

import java.io.*;
import java.util.ArrayList;

public class Main {
    public static void main(String[] args) throws IOException {
        Bayesian b = new Bayesian();
        ArrayList<Double> xinput = new ArrayList<>();
        ArrayList<Double> tinput = new ArrayList<>();
        ArrayList<Double> high = new ArrayList<>();
        ArrayList<Double> hightemp = new ArrayList<>();
        ArrayList<Double> low = new ArrayList<>();
        ArrayList<Double> lowtemp = new ArrayList<>();
        ArrayList<Double> close = new ArrayList<>();
        ArrayList<Double> closetemp = new ArrayList<>();
        ArrayList<Double> open = new ArrayList<>();
        ArrayList<Double> opentemp = new ArrayList<>();
        ArrayList<Double> volume = new ArrayList<>();
        ArrayList<String> Date = new ArrayList<>();

        String n1 = "GOOG1.csv";
        String n2 = "AAPL.csv";
        String n3 = "AMAZ.csv";
        String n4 = "CCf.csv";
        String n5 = "COKE.csv";
        String n6 = "FB.csv";
        String n7 = "INTC.csv";
        String n8 = "MSFT.csv";
        String n9 = "ORCL.csv";
        String n10 = "YHOO.csv";
        String[] n = {n1,n2,n3,n4,n5,n6,n7,n8,n9,n10};
        FileOutputStream fs = new FileOutputStream("predict.txt");
        PrintStream p = new PrintStream(fs);
        for (int i = 0; i < 10; i++) {
            xinput.clear();
            tinput.clear();
            high.clear();
            hightemp.clear();
            low.clear();
            lowtemp.clear();
            close.clear();
            closetemp.clear();
            open.clear();
            opentemp.clear();
            volume.clear();




            MatrixCon.readIn(n[i], volume, xinput, 5);
            int count = MatrixCon.readIn(n[i], tinput, xinput, 2);
            MatrixCon.copy(tinput, high);
            int pre = 0;
            while (pre++ < 7) {
                double temp = b.Bayes(xinput, tinput, count);
                hightemp.add(temp);
                tinput.add(temp);
                count++;
                xinput.add((double) count);
            }
            xinput.clear();
            tinput.clear();


            count = MatrixCon.readIn(n[i], tinput, xinput, 3);
            MatrixCon.copy(tinput, low);
            pre = 0;
            while (pre++ < 7) {
                double temp = b.Bayes(xinput, tinput, count);
                lowtemp.add(temp);
                tinput.add(temp);
                count++;
                xinput.add((double) count);
            }
            xinput.clear();
            tinput.clear();


            count = MatrixCon.readIn(n[i], tinput, xinput, 4);
            MatrixCon.copy(tinput, close);
            pre = 0;
            while (pre++ < 7) {
                double temp = b.Bayes(xinput, tinput, count);
                closetemp.add(temp);
                tinput.add(temp);
                count++;
                xinput.add((double) count);
            }

            xinput.clear();
            tinput.clear();
            count = MatrixCon.readIn(n[i], tinput, xinput, 1);
            MatrixCon.copy(tinput, open);
            pre = 0;
            while (pre++ < 7) {
                double temp = b.Bayes(xinput, tinput, count);
                opentemp.add(temp);
                tinput.add(temp);
                count++;
                xinput.add((double) count);
            }


            ArrayList<String> td = new ArrayList<>();
            Reader readin = new FileReader(n[i]);
            Iterable<CSVRecord> records = null;
            records = CSVFormat.EXCEL.parse(readin);
            int asd = 0;
            for (CSVRecord record : records) {
                td.add(record.get(0));
               ++asd;
            }
            for(int kk =asd-1; kk >=0; kk--){
                Date.add(td.get(kk));
            }


            double[] weight1out = new double[4];
            double[] weight2out = new double[4];
            ArrayList<Double> out = new ArrayList<>();

            Ann q = new Ann(n[i]);
            q.train(weight1out, weight2out);
            q.predict(high, low, out, weight1out, weight2out);
            for (int j = hightemp.size()-1; j >=0 ; j--) {
                System.out.print("Day" + (j + 1) +"     Open"+ opentemp.get(j)+ ": High:" + hightemp.get(j) + "  Low:" + lowtemp.get(j) +
                        "  Close:" + closetemp.get(j) +
                        " Volume: " + q.output.get(j) * Math.pow(10,q.digit));
                System.out.println();
            }
            for (int j = high.size()-1; j >=0 ; j--) {
                System.out.print(Date.get(j) + "     Open"+ open.get(j)+": High:" + high.get(j) + "  Low:" + low.get(j) +
                        "  Close:" + close.get(j) +
                        " Volume: " + volume.get(j));
                System.out.println();
            }

//            FileOutputStream fs = new FileOutputStream(new File("Prediction.txt"));
//            PrintStream p = new PrintStream(fs);
//            for(int j = 0; j < high.size(); j++) {
//
//                p.print(("Day" + (j + 1) + ": High:" + high.get(j) + "  Low:" + low.get(j) +
//                        "  Close:" + close.get(j) +
//                        " Volume: " + q.output.get(j) * 10000000));
//                p.println();
//            }
            String newPath = "new" + n[i];
            try {
                FileWriter fw = new FileWriter(newPath);
                String header = "Date,Open,High,Low,Close,Volumn,Adj close\r\n";
                fw.write(header);
//                StringBuffer space = new StringBuffer();

//                fw.append(space.toString());
//                fw.flush();
                for (int k = hightemp.size()-1; k >=0 ; k--) {
                    StringBuffer str = new StringBuffer();

                    str.append((k + 1) + "," + opentemp.get(k) + "," + hightemp.get(k) + "," + lowtemp.get(k) +
                            "," + closetemp.get(k) +
                            "," + q.output.get(k) * Math.pow(10,q.digit) + "," + close.get(k) + "\r\n");

                    fw.append(str.toString());
                    fw.flush();
                }
                for (int k = high.size()-1; k >=0 ; k--) {
                    StringBuffer str = new StringBuffer();

                    str.append(Date.get(k) + "," + open.get(k) + "," + high.get(k) + "," + low.get(k) +
                            "," + close.get(k) +
                            "," + volume.get(k) + "," + close.get(k) + "\r\n");

                    fw.append(str.toString());
                    fw.flush();

                }


                p.append(n[i] + ":" + open.get(0) + "," + high.get(0) + "," + low.get(0) +
                        "," + close.get(0) +
                        "," + volume.get(0) + "," + close.get(0) + "\r\n");
                fw.close();

            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    }


}



