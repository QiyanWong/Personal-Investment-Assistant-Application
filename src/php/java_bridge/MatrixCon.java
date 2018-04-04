/**
 * Created by qiyanwang on 2017/4/16.
 */
import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVRecord;

import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.io.Reader;
import java.util.ArrayList;

/**
 * Created by qiyanwang on 2017/2/24.
 */
public class MatrixCon {
    static void phiMatrix(double[][]a,ArrayList<Double> x,int count){
        for( int i=0; i<count; i++){
            a[0][i]=1;
        }
        for( int i=0; i<count; i++){
            a[1][i]=x.get(i);
        }
        for( int i=2; i<3; i++){
            for(int j=0; j<count; j++){
                a[i][j]=a[i-1][j]*a[0][j];
            }
        }
    }

    static int readIn(String path, ArrayList<Double> t, ArrayList<Double> x, int row) throws IOException {
        Reader readin = new FileReader(path);
        int count = 0;
        double[] xtemp = new double[9999];
        double[] ttemp = new double[9999];
        Iterable<CSVRecord> records = null;
        records = CSVFormat.EXCEL.parse(readin);
        for (CSVRecord record : records) {
            xtemp[count] = count;
            ttemp[count] = Double.parseDouble(record.get(row));
            count++;
        }
        for(int i=count-1; i>=0; i--){
            x.add(xtemp[i]);
            t.add(ttemp[i]);
        }
        return count;
    }

    static void copy(ArrayList<Double> in, ArrayList<Double> out){
        for(int i = 0; i < in.size(); i++){
            out.add(in.get(i));
        }



        }
        public static int sizeOfInt(double x) {
        final int[] sizeTable = {9, 99, 999, 9999, 99999, 999999, 9999999,
                99999999, 999999999, Integer.MAX_VALUE};

        for (int i = 0; ; i++)
            if (x <= sizeTable[i])
                return 10;
    }

}
