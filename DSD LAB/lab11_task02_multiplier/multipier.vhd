// multiplier_combined.v

// ---------------- Control Module ----------------
module multiplier_control (
    input wire clk,
    input wire reset,
    output reg Asel,
    output reg Ale,
    output reg done
);
    reg [1:0] state;

    parameter S0 = 2'b00;
    parameter S1 = 2'b01;
    parameter S2 = 2'b10;
    parameter S3 = 2'b11;

    always @(posedge clk or posedge reset) begin
        if (reset)
            state <= S0;
        else begin
            case (state)
                S0: state <= S1;
                S1: state <= S2;
                S2: state <= S3;
                S3: state <= S3;
            endcase
        end
    end

    always @(*) begin
        Asel = 0;
        Ale  = 0;
        done = 0;
        case (state)
            S1: Asel = 1;
            S2: Ale  = 1;
            S3: done = 1;
        endcase
    end
endmodule

// ---------------- Datapath Module ----------------
module multiplier_datapath (
    input wire clk,
    input wire reset,
    input wire [3:0] A,
    input wire [3:0] B,
    input wire Asel,
    input wire Ale,
    output reg [7:0] result
);
    reg [3:0] multiplicand;
    reg [3:0] counter;
    reg [7:0] product;

    always @(posedge clk or posedge reset) begin
        if (reset) begin
            multiplicand <= 0;
            counter <= 0;
            product <= 0;
            result <= 0;
        end else begin
            if (Asel) begin
                multiplicand <= A;
                counter <= B;
                product <= 0;
            end else if (Ale && counter > 0) begin
                product <= product + multiplicand;
                counter <= counter - 1;
            end
            result <= product;
        end
    end
endmodule

// ---------------- Top Module ----------------
module multiplier_top (
    input wire clk,
    input wire reset,
    input wire [3:0] A,
    input wire [3:0] B,
    output wire [7:0] result,
    output wire done
);
    wire Asel, Ale;

    multiplier_control control (
        .clk(clk),
        .reset(reset),
        .Asel(Asel),
        .Ale(Ale),
        .done(done)
    );

    multiplier_datapath datapath (
        .clk(clk),
        .reset(reset),
        .A(A),
        .B(B),
        .Asel(Asel),
        .Ale(Ale),
        .result(result)
    );
endmodule
