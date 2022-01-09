package com.kelompok.emajer.Activity.Transaksi.PembayaranKas;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.kelompok.emajer.API.APIRequestPembayaranKas;
import com.kelompok.emajer.API.APIUtils;
import com.kelompok.emajer.HomeActivity;
import com.kelompok.emajer.Model.PembayaranKas.TransaksiDetail;
import com.kelompok.emajer.Model.PembayaranKas.PilihMinggu;
import com.kelompok.emajer.Model.PembayaranKas.Transaksi;
import com.kelompok.emajer.Model.PembayaranKas.TransaksiResponse;
import com.kelompok.emajer.R;
import com.kelompok.emajer.SessionManager;

import java.text.NumberFormat;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class detailpembayarankas extends AppCompatActivity {
    private APIRequestPembayaranKas apiRequestPembayaranKas;

    List<PilihMinggu> pilihMingguList = new ArrayList<>();

    TextView tvTotal;
    Button btnBayar;
    ImageView btnBack;
    SessionManager SessionManager;
    LinearLayout llDpkMingguBayar;
    CheckBox[] ch;
    Integer totalTagihan = 0;
    String id_akun , id_kelas;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detailpembayarankas);
        apiRequestPembayaranKas = APIUtils.getReqBayarKas();

        SessionManager = new SessionManager(this);
        id_akun = String.valueOf(SessionManager.getUserId());
        id_kelas = String.valueOf(SessionManager.getIdKelas());
        btnBack = (ImageView) findViewById(R.id.btnBack_dtl_pembayaran_kas);
        btnBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                onBackPressed();
            }
        });
        // Ambil Array yang dikirim melalu intent
        Intent intent = getIntent();
        Bundle args = intent.getBundleExtra("BUNDLE");
        pilihMingguList = (ArrayList) args.getSerializable("ARRAYLIST");

        setCheckbox(); // membuat checkbox

    }
    private void setCheckbox(){
        llDpkMingguBayar = findViewById(R.id.dpkMingguBayar);
        tvTotal = findViewById(R.id.dpkTotal);
        btnBayar = findViewById(R.id.dpkBtnBayar);

        List<PilihMinggu> mList = pilihMingguList;

        ch = new CheckBox[mList.size()];
        for(int i=0; i<mList.size(); i++) {
            totalTagihan += mList.get(i).getNominal();

            ch[i] = new CheckBox(this);
            String keterangan = mList.get(i).getKeterangan();
            int idMinggu = mList.get(i).getIdMinggu();
            Integer nominal = mList.get(i).getNominal();
            ch[i].setId(idMinggu);
            ch[i].setText(keterangan + " | "+formatRupiah(Double.parseDouble(nominal.toString())) );
            ch[i].setTextColor(Color.parseColor("#000000"));
            ch[i].setEnabled(false);
            ch[i].setChecked(true);
//            ch[i].setButtonDrawable(0);

            llDpkMingguBayar.addView(ch[i]);
        }
        tvTotal.setText(formatRupiah(Double.parseDouble(totalTagihan.toString())));

        btnBayar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                inputTransaksi();
            }
        });
    }

    private void inputTransaksi(){
        List<TransaksiDetail> transaksiDetail = new ArrayList<>();
        List<PilihMinggu> mList = pilihMingguList;
        for(int i=0; i<mList.size(); i++) {
            TransaksiDetail dtTrans = new TransaksiDetail();
            dtTrans.setId_minggu(mList.get(i).getIdMinggu());
            transaksiDetail.add(dtTrans);
        }

        Transaksi transaksi = new Transaksi();
        transaksi.setId_akun(id_akun);
        transaksi.setId_kelas(id_kelas);
        transaksi.setTotal(totalTagihan);
        transaksi.setTransaksiDetail(transaksiDetail);

        Call<TransaksiResponse> call = apiRequestPembayaranKas.kirimTransaksi(transaksi);
        call.enqueue(new Callback<TransaksiResponse>() {
            @Override
            public void onResponse(Call<TransaksiResponse> call, Response<TransaksiResponse> response) {
                if (response.isSuccessful()){
                    String msg = response.body().getMessage();

                    startActivity(new Intent(getBaseContext(), HomeActivity.class));
                    finish();

                    Toast.makeText(getBaseContext(),msg,Toast.LENGTH_SHORT).show();
                }else{
                    Toast.makeText(getBaseContext(),"Gagal input Transaksi",Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<TransaksiResponse> call, Throwable t) {
                Toast.makeText(getBaseContext(),"Gagal konek server: "+ t.getLocalizedMessage(),Toast.LENGTH_SHORT).show();
            }
        });
    }
    public String formatRupiah(Double number){
        Locale localeID = new Locale("in", "ID");
        NumberFormat formatRupiah = NumberFormat.getCurrencyInstance(localeID);
        return formatRupiah.format(number);
    }
}