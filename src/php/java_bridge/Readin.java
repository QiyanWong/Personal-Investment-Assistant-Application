

import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVRecord;

import java.io.*;

import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVRecord;

import java.io.FileReader;
import java.io.IOException;
import java.io.Reader;
import java.math.BigDecimal;
import java.util.*;

/**
     * Created by qiyanwang on 2017/2/24.
     */
    public class Readin{

        static int input(String path, ArrayList<Double> x,ArrayList<Double> y,ArrayList<Double>output, int row1, int row2,int row3) throws IOException {
            Reader readin = new FileReader(path);
            int count = 0;
            double[] xtemp = new double[9999];
            double[] ttemp = new double[9999];
            double[] vtemp = new double[9999];
            Iterable<CSVRecord> records = null;
            records = CSVFormat.EXCEL.parse(readin);
            for (CSVRecord record : records) {
                xtemp[count] = Double.parseDouble(record.get(row1));
                ttemp[count] = Double.parseDouble(record.get(row2));
                vtemp[count] =(Double.valueOf(record.get(row3)));
                count++;
            }

            for(int i=count; i>=0; i--){
                count = MatrixCon.sizeOfInt(vtemp[i])+1;
               double temp1 = vtemp[i]/Math.pow(10,MatrixCon.sizeOfInt(vtemp[i])+1);
                double temp2 = ttemp[i]/Math.pow(10,MatrixCon.sizeOfInt(ttemp[i])+1);
                double temp3 = xtemp[i]/Math.pow(10,MatrixCon.sizeOfInt(xtemp[i])+1);
                x.add(temp3);
                y.add(temp2);
                output.add(temp1);

            }
            return count;
        }

        static void MatrixCopy(double[][] a, double[] b, int count) {
            for (int i = 0; i < count; i++) {
                for (int j = 0; j < 3; j++) {
                    b[j] = a[j][i];
                }
            }
        }

    }


